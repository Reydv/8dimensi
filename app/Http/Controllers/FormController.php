<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Jawaban;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Helpers\Validation\Validation;
use Helpers\Data\DiscHelper;
use Helpers\Data\SectionTwoHelper;
use Helpers\Data\StringHelper;
use Helpers\Validation\JumperValidation;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class FormController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode-akses' => 'required'
        ]);

        $user = auth()->user();
        $accessCode = $request->input('kode-akses');
        $event = Event::where('kode_akses', '=', $accessCode)
            ->first();

        if (!$event) {
            return redirect()->back()->withErrors(['kode-akses' => 'Kode akses event tidak sesuai']);
        }


        $startDate = $event->tanggal_mulai;
        $expirationDate = $event->tanggal_selesai;

        if (Validation::isEventNotStarted($startDate, $expirationDate)) {
            return redirect()->back()->withErrors(['kode-akses' => 'Event belum dimulai']);
        }
        if (Validation::isEventExpired($startDate, $expirationDate)) {
            return redirect()->back()->withErrors(['kode-akses' => 'Event sudah berakhir']);
        }

        $answer = Jawaban::where('event_id', '=', $event->id)
            ->where('user_id', '=', $user->id)
            ->latest()
            ->first();

        if ($answer) {
            if ($answer->progress != 'selesai') {
                return redirect()->route('user.form.show', [
                    'jawaban' => $answer,
                    'destination' => 'section-1-1'
                ]);
            }
            if ($answer->progress == 'selesai') {
                return redirect()->back()->withErrors(['kode-akses' => 'Anda sudah mengisi jawaban di event ini']);
            }

            return redirect()->back()->withErrors(['kode-akses' => 'Terjadi kesalahan sistem']);
        }

        Jawaban::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'progress' => 'section-1-1'
        ]);


        $newAnswer = Jawaban::where('event_id', '=', $event->id)
            ->where('user_id', '=', $user->id)
            ->first();

        // $sessionKey = 'answers-' . $newAnswer->id;
        // session([$sessionKey => []]);

        return redirect()->route('user.form.show', [
            'jawaban' => $newAnswer,
            'destination' => 'section-1-1',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Jawaban $jawaban)
    {
        $destination = strtolower(request('destination'));
        $destination = str_replace(array(" ", "\t", "\n", "\r"), "", $destination);

        if (JumperValidation::isJumping($jawaban->id, $destination)) {
            return redirect()->route('user.form.jumper', ['jawaban' => $jawaban->id]);
        }

        $questions = "";
        $pageSection = 0;
        $nextDestination = "";
        $previousDestination = "";
        $contoh = false;

        switch ($destination) {
            case "section-1-1":
                $questions = config('form-section1-1.content');
                $pageSection = 1;
                $nextDestination = 'section-1-2';
                $previousDestination = 'go-dashboard';
                $contoh = true;
                break;
            case "section-1-2":
                $questions = config('form-section1-2.content');
                $pageSection = 1;
                $nextDestination = 'section-1-3';
                $previousDestination = 'section-1-1';
                break;
            case "section-1-3":
                $questions = config('form-section1-3.content');
                $pageSection = 1;
                $nextDestination = 'section-wait';
                $previousDestination = 'section-1-2';
                break;
            case "section-2-1":
                $questions = config('form-section2-1.content');
                $pageSection = 2;
                $nextDestination = 'section-2-2';
                $previousDestination = 'section-1-3';
                $contoh == true;
                break;
            case "section-2-2":
                $questions = config('form-section2-2.content');
                $pageSection = 2;
                $nextDestination = 'submit';
                $previousDestination = 'section-2-1';
                break;
            case "section-wait":
                return view('alt-form/section-wait', [
                    'nextDestination' => 'section-2-1',
                    'jawaban' => $jawaban,
                    'isAdmin' => Validation::isAdmin(auth()->user()->email),
                    'user' => auth()->user()
                ]);
            default:
                dd('idk', $destination);
        }

        $viewName = '';
        $answers = [];

        $sessionData = session('answers-' . $jawaban->id, ['checkbox' => [], 'range' => []]);

        if ($pageSection == 1) {
            $viewName = 'alt-form/section-1';
            $answers = $sessionData['checkbox'];
        } else if ($pageSection == 2) {
            $viewName = 'alt-form/section-2';
            $answers = $sessionData['range'];
        } else {
            abort(404);
        }

        return view($viewName, [
            'jawaban' => $jawaban,
            'questions' => $questions,
            'answers' => $answers,
            'nextDestination' => $nextDestination,
            'previousDestination' => $previousDestination,
            'isAdmin' => Validation::isAdmin(auth()->user()->email),
            'user' => auth()->user(),
            'contoh' => isset($contoh) ? $contoh : false,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jawaban $jawaban)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jawaban $jawaban)
    {
        
        request()->validate([
            'destination' => 'required',
            'checkbox' => 'sometimes|array|required_array_keys:p,t|size:2',
            'checkbox.p' => 'array|size:8',
            'checkbox.t' => 'array|size:8',
            'range' => 'required_without:checkbox|array|size:10'
        ]);
        
        request()->validate([
            'destination' => 'required',
            'checkbox' => 'sometimes|array|required_array_keys:p,t|size:2',
            'checkbox.p' => 'array|size:8',
            'checkbox.t' => 'array|size:8',
            'range' => 'required_without:checkbox|array|size:10'
        ]);
    
        $destination = $request->input('destination');
        $user = User::with('jawabans')->find(auth()->id());

        $userAnswer = $user->jawabans()->latest()->first();
        $userAnswer->progress = $destination;
        $userAnswer->save();

        //pembatas
        $checkboxAnswers = $request->input('checkbox', ['p' => [], 't' => []]);
        $rangeAnswers = $request->input('range', []);

        $this->saveAnswer($jawaban->id, $checkboxAnswers, $rangeAnswers);
        return redirect()->route('user.form.show', [
            'jawaban' => $jawaban,
            'destination' => $destination
        ]);
    }

    public function updateBack(Request $request, Jawaban $jawaban)
    {
        request()->validate([
            'destination' => 'required',
        ]);

        $destination = $request->input('destination');
        $user = User::with('jawabans')->find(auth()->id());

        $userAnswer = $user->jawabans()->latest()->first();
        $userAnswer->progress = $destination;
        $userAnswer->save();

        // scaniiwocca        
        $checkboxAnswers = $request->input('checkbox', ['p' => [], 't' => []]);
        $rangeAnswers = $request->input('range', []);

        $this->saveAnswer($jawaban->id, $checkboxAnswers, $rangeAnswers);

        return redirect()->route('user.form.show', [
            'jawaban' => $jawaban,
            'destination' => $destination
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jawaban $jawaban)
    {
        $jawaban->delete();
    }

    // submit di save dlu di saveAnswer
    public function submit(Jawaban $jawaban)
    {
        request()->validate([
            'checkbox' => 'sometimes|array|required_array_keys:p,t|size:2',
            'checkbox.p' => 'array|size:8',
            'checkbox.t' => 'array|size:8',
            'range' => 'required_without:checkbox|array|size:10'
        ]);

        $checkboxAnswers = request('checkbox', ['p' => [], 't' => []]);
        $rangeAnswers = request('range', []);

        $this->saveAnswer($jawaban->id, $checkboxAnswers, $rangeAnswers);

        if (JumperValidation::isJumpingSubmit($jawaban->id)) {
            dd('tes no');
        }

        $answer = session('answers-' . $jawaban->id);
        $answerSection1P = $answer['checkbox']['p'];
        $answerSection1T = $answer['checkbox']['t'];
        $answerSection2 = $answer['range'];

        $mostValue = DiscHelper::normalizeDiscValue($answerSection1P);
        $leastValue = DiscHelper::normalizeDiscValue($answerSection1T);
        $changeValue = DiscHelper::getChangeValue($mostValue,  $leastValue);

        $answerSection2 = SectionTwoHelper::normalizeData($answerSection2);

        $graph2Value = DiscHelper::calculateGraphValue($leastValue, config('graph-key.graph2'));
        $graph3Value = DiscHelper::calculateGraphValue($changeValue, config('graph-key.graph3'));

        $dimension = null;

        $inconsistentDimension = DiscHelper::checkInconsistent($graph2Value, $graph3Value);
        if (isset($inconsistentDimension)) {
            $dimension = $inconsistentDimension[0];
        } else {
            $dimension = DiscHelper::decideDimension($graph2Value, $graph3Value);
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
        $collabLogo = null;
        if(isset($jawaban->event->collab_logo_name)){
            if (file_exists(public_path('collab-logo/' . $jawaban->event->collab_logo_name))) {
                $collabLogo = base64_encode(file_get_contents(public_path('collab-logo/' . $jawaban->event->collab_logo_name)));
            }
        }
        $collabUrl = $jawaban->event->collab_url;
        $collabCompanyName = ($jawaban->event->is_institution_hold == false) ? $jawaban->event->institusi : null;

        $pdfFileName = 'Laporan Dimensi - ' .  $name . ' - ' . StringHelper::replaceDate(date('j F Y'));

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
            'inconsistentDimension' => isset($inconsistentDimension[1]) ? $inconsistentDimension[1] : '',
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
        $pdfRelativePath = 'pdf/' . $pdfFileName . '.pdf';

        file_put_contents($pdfPath, $dompdf->output());

        $jawaban->pdf_filepath = $pdfRelativePath;
        $jawaban->pdf_original_name = $pdfFileName;

        // if(isset($inconsistentDimension[1])){
        //     $jawaban->inconsistent_dimension = $inconsistentDimension[1];
        // }

        $jawaban->dimensi_kepemimpinan = $dimension;

        $jawaban->type1_formatted_value = json_encode([
            'most_value' => $mostValue,
            'least_value' => $leastValue,
            'change_value' => $changeValue
        ]);

        $jawaban->type2_formatted_value = json_encode([
            'value' => $answerSection2
        ]);

        $jawaban->progress = 'selesai';
        $jawaban->save();

        return redirect()->route('user.form.finish');
    }

    public function updateProgress(Request $request, Jawaban $jawaban)
    {
        request()->validate([
            'destination' => 'required',
        ]);

        $currentPath = $request->input('destination');
        $user = User::with('jawabans')->find(auth()->id());

        $userAnswer = $user->jawabans()->latest()->first();
        $userAnswer->progress = $currentPath;
        $userAnswer->save();

        return redirect()->route('user.form.show', [
            'jawaban' => $jawaban,
            'destination' => 'section-1-1'
        ]);
    }

    public function saveAnswer(int $jawabanId, array $checkboxAnswers = ['p' => [], 't' => []], array $rangeAnswers = [])
    {
        $sessionKey = 'answers-' . $jawabanId;
        $sessionData = session($sessionKey, ['checkbox' => ['p' => [], 't' => []], 'range' => []]);
        
        if ($checkboxAnswers) {
            if(isset($checkboxAnswers['p'])){
                $sessionData['checkbox']['p'] = $checkboxAnswers['p'] + $sessionData['checkbox']['p'];
            }
            if(isset($checkboxAnswers['t'])){
                $sessionData['checkbox']['t'] = $checkboxAnswers['t'] + $sessionData['checkbox']['t'];
            }
        }

        if ($rangeAnswers) {
            $sessionData['range'] =  $rangeAnswers + $sessionData['range'];
        }

        session([$sessionKey => $sessionData]);
    }
}
