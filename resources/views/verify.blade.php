@php use Laravel\Nova\Nova; @endphp
  <!DOCTYPE html>
<html lang="{{ $locale = Nova::resolveUserLocale(request()) }}"
      dir="{{ Nova::rtlEnabled() ? 'rtl' : 'ltr' }}" class="h-full font-sans antialiased">
<head>
  <meta name="theme-color" content="#fff">
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width"/>
  <meta name="locale" content="{{ $locale }}"/>
  <meta name="robots" content="noindex">

  <link rel="stylesheet" href="{{ mix('app.css', 'vendor/nova') }}">

  <style>
    :root {
      @foreach(Nova::brandColors() as $key => $value)
           --colors-primary-{{ $key }}: {{ $value }};
      @endforeach
    }
  </style>

  @if ($styles = Nova::availableStyles(request()))
    @foreach($styles as $asset)
      <link rel="stylesheet" href="{!! $asset->url() !!}">
    @endforeach
  @endif

  <title>Authentification forte</title>
</head>
<body class="min-w-site text-sm font-medium min-h-full text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-900">

<div class="py-6 px-1 md:px-2 lg:px-6">
  <div class="mx-auto py-8 max-w-sm flex justify-center">
    {!! Nova::logo() !!}
  </div>

  <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-8 max-w-[25rem] mx-auto">
    <form method="POST" action="{{ route('nova.2fa.verify') }}">
      @csrf
      <div class="text-center mb-6">
        <h2 class="text-2xl text-center font-normal mb-6">Authentification forte</h2>
        <p><b>Pour confirmer votre identité veuillez saisir le code que vous avez reçu</b></p>
      </div>

      <div class="mb-6">
        <label class="block mb-2" for="code">Code de vérification</label>
        <input
          class="form-control form-input form-input-bordered w-full @error('code') form-input-border-error @enderror"
          id="code" type="text" name="code" required/>

        @error('code')
        <span class="mt-2 text-red-500">{{ $message }}</span>
        @enderror
        @if(session()->has('message'))
          <span class="mt-2 text-green-500">{{ session()->get('message') }}</span>
        @endif
      </div>

      <button type="submit"
              class="border text-left appearance-none cursor-pointer rounded text-sm font-bold focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 relative disabled:cursor-not-allowed inline-flex items-center justify-center shadow h-9 px-3 bg-primary-500 border-primary-500 hover:[&:not(:disabled)]:bg-primary-400 hover:[&:not(:disabled)]:border-primary-400 text-white dark:text-gray-900 w-full flex justify-center">
        Continuer
      </button>
    </form>
  </div>
</div>
</body>
</html>
