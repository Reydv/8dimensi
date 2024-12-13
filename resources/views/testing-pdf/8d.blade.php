<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @page page {
            size: A4 portrait;
            margin: 2cm;
        }

        .pageSeparator {
            page: page;
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="pageSeparator">
        Page1
    </div>
    <div class="pageSeparator">
        Page2
    </div>
    <div class="pageSeparator">
        Page3
    </div>
    <div class="pageSeparator">
        Page4
    </div>

</body>

</html>