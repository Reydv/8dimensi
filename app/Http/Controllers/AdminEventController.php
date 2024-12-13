<?php

namespace App\Http\Controllers;

use App\Models\Event;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use App\Models\Info;
use App\Models\Jawaban;
use App\Models\User;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Helpers\Data\EventOverviewHelper;
use Helpers\Data\EventStatHelper;
use Helpers\Data\StringHelper;
use Helpers\Validation\Validation;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdminEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $yearRequested = request('year', date('Y'));

        $allEvents = Event::where('tanggal_selesai', 'like', '%' . $yearRequested . '%')
            ->with('jawabans.user')->get();

        $eventAnswers = $allEvents->flatMap(function ($event) {
            return $event->jawabans;
        });

        $eventUsers = $eventAnswers->pluck('user')->unique();

        $usersGender = EventStatHelper::calculateGenderDispersion($eventUsers->pluck('jenis_kelamin')->toArray());
            // dd($eventUsers->pluck('usia')->toArray());
        $usersAge = EventStatHelper::calculateAgeDispersion($eventUsers->pluck('usia')->toArray()); //ini error
        $usersLastEducation = EventStatHelper::calculateEducationDispersion($eventUsers->pluck('pendidikan_terakhir')->toArray());
        $usersResidence = EventStatHelper::calculateResidenceDispersion($eventUsers->pluck('domisili')->toArray());

        $eventsGoalStatistic = EventOverviewHelper::calculateEventsGoal($allEvents->pluck('tujuan_tes')->toArray());
        
        $eventsTotalParticipant = $eventAnswers->count();

        $latestEvent = Event::latest()
            ->where('tanggal_selesai', 'like', '%' . $yearRequested . '%')
            ->where('tanggal_selesai', '>', now())->get();
        $expiredEvents = Event::latest()
            ->where('tanggal_selesai', 'like', '%' . $yearRequested . '%')
            ->where('tanggal_selesai', '<', now())->get();
            
        $nickname = StringHelper::pickFirstWord(auth()->user()->name);
        
        return view('admin/index', [
            'user' => auth()->user(),
            // 'event' => $events,
            'latestEvents' => $latestEvent,
            'expiredEvents' => $expiredEvents,
            'gender' => $usersGender,
            'age' => $usersAge,
            'education' => $usersLastEducation,
            'domisili' => $usersResidence,
            'goal' => $eventsGoalStatistic,
            'totalParticipant' => $eventsTotalParticipant,
            // 'institution' => array_slice($usersResidence, 0, 3),
            'isAdmin' => Validation::isAdmin(auth()->user()->email),
            'year' => $yearRequested,
            'nickname' => $nickname,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json([
            'edit' => false,
            'create' => true
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'nama' => 'required|string|max:60',
            'kode_akses' => 'required|unique:events|string|max:25',
            'institusi' => 'required|string|max:255',
            'collab_logo_base64' => 'mimes:png,jpeg,jpg',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'deskripsi' => 'required|string|max:255',
            'tujuan_tes' => 'required|string|max:255|not_in:0',
            'collab_url' => 'nullable|string|max:255',
        ]);

        Event::create([
            'nama' => $request->input('nama'),
            'kode_akses' => $request->input('kode_akses'),
            'institusi' => $request->input('institusi'),
            'tanggal_mulai' => $request->input('tanggal_mulai'),
            'tanggal_selesai' => $request->input('tanggal_selesai'),
            'deskripsi' => $request->input('deskripsi'),
            'tujuan_tes' => $request->input('tujuan_tes'),
            'collab_url' => $request->input('collab_url'),
            'is_answers_hold' => false,
            'is_institution_hold' => false,
        ]);

        if ($request->hasFile('collab_logo_base64')) {
            // $img = $request->file('collab_logo_base64')->store('collab-logo');
            // $img = Storage::disk('local')->put('images/', $request->file('collab_logo_base64'));
            $event = Event::latest()->first();

            $file = $request->file('collab_logo_base64');
            $name = 'logo-event-' . $event->id . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('collab-logo'), $name);

            $event->collab_logo_name = $name;
            $event->save();
        }


        // dd([
        //     'nama' => $request->input('nama'),
        //     'kode_akses' => $request->input('kode_akses'),
        //     'institusi' => $request->input('institusi'),
        //     'tanggal_mulai' => $request->input('tanggal_mulai'),
        //     'tanggal_selesai' => $request->input('tanggal_selesai'),
        //     'deskripsi' => $request->input('deskripsi'),
        //     'tujuan_tes' => $request->input('tujuan_tes'),
        //     'collab_logo_base64' => $img,
        //     'collab_url' => $request->input('collab_url'),
        //     'is_answers_hold' => false,
        // ]);

        return redirect()->back()->with('success', 'Event berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $currentEvent = $event->jawabans()->with('user')->get();
        $users = $currentEvent->pluck('user')->unique();

        $totalUser = $users->count();
        $totalJawaban = $currentEvent->count();
        // dd($currentEvent->count());
        $finishedUser = $currentEvent->where('progress', '=', 'selesai')->count();
        $unfinishedUser = $currentEvent->where('progress', '!=', 'selesai')->count();
        $finishedUserS = $currentEvent->where('progress', '=', 'selesai');
        $unfinishedUserS = $currentEvent->where('progress', '!=', 'selesai');

        // Gender Category = ['Laki-laki', 'Perempuan']
        $usersGender = EventStatHelper::calculateGenderDispersion($users->pluck('jenis_kelamin')->toArray());

        // Age Category = [<15, '15-20', '20-30', '30-40', '40-50', '50>']
        $usersAge = EventStatHelper::calculateAgeDispersion($users->pluck('usia')->toArray());

        // Education Category = ['sd', 'smp', 'sma', 'smk', 'd1', 'd2', 'd3', 'd4', 's1', 's2', 's3']
        $usersLastEducation = EventStatHelper::calculateEducationDispersion($users->pluck('pendidikan_terakhir')->toArray());
        /**
         * ~ Size depends on users resident dispersion
         * ~ Filtered by number
         * Residence Category = ['X1' => 14, 'X2' => 7, 'X3' => 4]
         */
        $usersResidence = EventStatHelper::calculateResidenceDispersion($users->pluck('domisili')->toArray());

        // 8 Dimensions Category = ['Pelopor', 'Penggerak', 'Afirmasi', 'Inklusif', 'Rendah Hati', 'Pemikir', 'Tegas', 'Berwibawa']
        $usersDimension = EventStatHelper::calculate8DimensionsDispersion($currentEvent->pluck('dimensi_kepemimpinan')->toArray());

        $timeStart = StringHelper::replaceDate(Carbon::parse($event->tanggal_mulai)->format('d F Y'));
        $timeEnd = StringHelper::replaceDate(Carbon::parse($event->tanggal_selesai)->format('d F Y'));

        $imgPath = $event->collab_logo_name;

        return view('admin.show', [
            'timeStart' => $timeStart,
            'timeEnd' => $timeEnd,
            'event' => $event,
            'peserta' => $users,
            'users' => $totalUser,
            'totalJawaban' => $totalJawaban,
            'user' => auth()->user(),
            'finishedUser' => $finishedUser,
            'unfinishedUser' => $unfinishedUser,
            'finishedUserS' => $finishedUserS,
            'unfinishedUserS' => $unfinishedUserS,
            'kelamin' => $usersGender,
            'usia' => $usersAge,
            'pendidikan' => $usersLastEducation,
            'domisili' => $usersResidence,
            'penyebaran8D' => $usersDimension,
            'daftarUser' => [
                'selesai' => $finishedUser,
                'mengerjakan' => $unfinishedUser,
            ],
            'isAdmin' => Validation::isAdmin(auth()->user()->email),
            'img' => $imgPath,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return response()->json([
            'edit' => true,
            'create' => false
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:60',
            // 'kode_akses' => 'required|unique:events|string|max:25',
            'institusi' => 'required|string|max:255',
            'collab_logo_base64' => 'mimes:png,jpeg,jpg',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'deskripsi' => 'required|string|max:255',
            'tujuan_tes' => 'required|string|max:255|not_in:0',
            'collab_url' => 'nullable|string|max:255',
        ]);

        $event = Event::find($id);


        if ($request->hasFile('collab_logo_base64')) {
            $file = $request->file('collab_logo_base64');
            $name = 'logo-event-' . $event->id . '.' . $file->getClientOriginalExtension();
            $deletePath = public_path('collab-logo/') . $event->collab_logo_name;
            
            if($event->collab_logo_name && file_exists($deletePath)) {
                unlink($deletePath);
            }

            $file->move(public_path('collab-logo'), $name);
            $event->collab_logo_name = $name;
        }

        $event->nama = $request->nama;
        // $event->kode_akses = $request->kode_akses;
        $event->institusi = $request->institusi;
        $event->tanggal_mulai = $request->tanggal_mulai;
        $event->tanggal_selesai = $request->tanggal_selesai;
        $event->deskripsi = $request->deskripsi;
        $event->tujuan_tes = $request->tujuan_tes;
        $event->collab_url = $request->collab_url;

        $event->save();

        return redirect()->route('admin.event.index', ['year' => $request->year]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::find($id);
        $path = public_path('collab-logo/') . $event->collab_logo_name;

        if($event->collab_logo_name && file_exists($path)) {
            unlink($path);
        }

        $event->jawabans()->delete();
        $event->delete();

        return redirect()->route('admin.event.index');
    }

    // Belum jadi
    public function overview()
    {
        $yearRequested = request('year', date('Y'));

        $allEvents = Event::where('tanggal_selesai', 'like', '%' . $yearRequested . '%')
            ->with('jawabans.user')->get();

        $eventAnswers = $allEvents->flatMap(function ($event) {
            return $event->jawabans;
        });
        $eventUsers = $eventAnswers->pluck('user')->unique();

        $finishedUser = $eventAnswers->where('progress', '=', 'selesai');
        $unfinishedUser = $eventAnswers->where('progress', '!=', 'selesai');

        $usersGender = EventStatHelper::calculateGenderDispersion($eventUsers->pluck('jenis_kelamin')->toArray());
        $usersAge = EventStatHelper::calculateAgeDispersion($eventUsers->pluck('usia')->toArray());
        $usersLastEducation = EventStatHelper::calculateEducationDispersion($eventUsers->pluck('pendidikan_terakhir')->toArray());
        $usersResidence = EventStatHelper::calculateResidenceDispersion($eventUsers->pluck('domisili')->toArray());
        $usersDimension = EventStatHelper::calculate8DimensionsDispersion($eventAnswers->pluck('dimensi_kepemimpinan')->toArray());

        $eventsGoalStatistic = EventOverviewHelper::calculateEventsGoal($allEvents->pluck('tujuan_tes')->toArray());
        $eventsTotalParticipant = EventOverviewHelper::calculateTotalParticipant($allEvents->pluck('total_peserta', 'tanggal_selesai')->toArray());
        $eventsInstitution = EventOverviewHelper::calculateInstitution($allEvents->pluck('institusi', 'tanggal_selesai')->toArray());

        return [
            'goal' => $eventsGoalStatistic,
            'participant' => $eventsTotalParticipant,
            'institusi' => $eventsInstitution,
            'progress' => [count($finishedUser), count($unfinishedUser)],
            'kelamin' => $usersGender,
            'usia' => $usersAge,
            'pendidikan' => $usersLastEducation,
            'domisili' => $usersResidence,
            'penyebaran8D' => $usersDimension,
        ];
    }

    public function updateCityApi()
    {
        $client = new Client();

        $response = $client->get('https://api.rajaongkir.com/starter/city', [
            'headers' => [
                'key' => 'idk'
            ],
        ]);

        $datas = json_decode($response->getBody(), true);

        $city = [];

        foreach ($datas['rajaongkir']['results'] as $data) {
            $city[] = $data['city_name'] . ', ' . $data['province'];
        }

        $finalData = json_encode(['city' => $city]);

        Info::updateOrCreate(
            ['name' => 'city'],
            ['json_value' => $finalData]
        );

        return response()->json(['city-update' => 'success']);
    }

    public function updateOnHold(Event $event)
    {
        $isHold = request('value', false);

        $event->is_answers_hold = $isHold;
        $event->save();

        return response()->json(['on-hold' => $isHold]);
    }
    
    public function updateInstitutionHold(Event $event)
    {
        $isHold = request('value', false);

        $event->is_institution_hold = $isHold;
        $event->save();

        return response()->json(['on-hold' => $isHold]);
    }

    public function eventPdfDownload(Jawaban $jawaban)
    {
        if (!Validation::isAdmin(auth()->user()->email)) {
            abort(403, 'Unauthorized'); // Or redirect to a "Not Permitted" page
        }
        
        
        $directory = storage_path('pdf');
        $filename = $jawaban->pdf_original_name . '.pdf';
        $filePath = $directory . DIRECTORY_SEPARATOR . $filename;

        if (file_exists($filePath)) {
            return response()->download($filePath, $filename);
        } else {
            return redirect()->back();
        }
    }

    public function eventPdfGenerate(Jawaban $jawaban)
    {
        if (!Validation::isAdmin(auth()->user()->email)) {
            abort(403, 'Unauthorized'); // Or redirect to a "Not Permitted" page
        }
        
        $user = $jawaban->user;

        $name = $user->name;
        $testDate = StringHelper::replaceDate(date('j F Y'));
        $nickname = StringHelper::pickFirstWord($name);
        $birthday = StringHelper::replaceDate(Carbon::parse($user->tanggal_lahir)->format('l, j F Y'));
        $education = isset($user->jurusan) ? $user->jurusan : null;
        $jobTitle = isset($user->jabatan) ? $user->jabatan : 'Undefined';
        $email = $user->email;
        $notelp = $user->notelp;
        $testPurpose = $jawaban->event->tujuan_tes;
        $gender = $user->jenis_kelamin;
        $dimension = $jawaban->dimensi_kepemimpinan;
        $collabLogo = null;
        
        if(isset($jawaban->event->collab_logo_name)){
            if (file_exists(public_path('collab-logo/' . $jawaban->event->collab_logo_name))) {
                $collabLogo = base64_encode(file_get_contents(public_path('collab-logo/' . $jawaban->event->collab_logo_name)));
            }
        }
        $collabUrl = $jawaban->event->collab_url;
        $collabCompanyName = ($jawaban->event->is_institution_hold == false) ? $jawaban->event->institusi : null;
        $inconsistentDimension = $jawaban->inconsistent_dimension;
        $answerSection2 = json_decode($jawaban->type2_formatted_value, true)['value'];
        
        $pdfFileName = $jawaban->pdf_original_name;

        $options = new Options();
        $options->set('chroot', storage_path());
        
        $html = View::make('template-pdf/8dimensi-master', [
            'name' => $name,
            'date' => $testDate,
            'nickname' => $nickname,
            'birthday' => $birthday,
            'education' => $education,
            'jobTitle' => $jobTitle,
            'email' => $email,
            'phoneNumber' => $notelp,
            'testPurpose' => $testPurpose,
            'dimension' => $dimension,
            'title' => 'Preview Laporan PDF',
            'gender' => $gender,
            'inconsistentDimension' => isset($inconsistentDimension) ? $inconsistentDimension : '',
            'score' => $answerSection2,

            'collabLogo' => $collabLogo,
            'collabCompany' => $collabCompanyName,
            'collabWatermark' => $collabUrl
        ])->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'potrait');

        $dompdf->render();

        $pdfDirectory = storage_path('pdf/');
        $pdfPath = $pdfDirectory . $pdfFileName . '.pdf';

        file_put_contents($pdfPath, $dompdf->output());

        return redirect()->back()->with('success', 'PDF berhasil dibuat kembali');
    }
}
