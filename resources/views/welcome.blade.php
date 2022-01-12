<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dots & Boxes</title>
    <style type="text/css">
      html { height: 100% }
      body { background-color: #198754 !important; }
      .vue-container { display: flex; margin-top: 5rem; margin-bottom: 5rem; background-color: #ffc107; min-height: calc(100% - 10rem); }
    </style>
  </head>
  <body class="h-100">
    <div class="container vue-container">
      <div id="app"></div>
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
  </body>
</html>
