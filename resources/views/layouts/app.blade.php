<head>
    <title>Larachat</title>
    @livewireStyles
    <script src="/js/app.js"></script>
    <link href="/css/app.css" rel="stylesheet">
</head>

<body class="">
    <header class="pl-4 py-2 bg-gray-700" x-data="{ 'location' : window.location.pathname}">
        <a class="text-white text-4xl" href="/">Quantic talk</a>
    </header>
    <div class="mx-96">
        {{ $slot }}
    </div>

 

    @livewireScripts

</body>