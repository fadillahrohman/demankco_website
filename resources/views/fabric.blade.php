@section('content')
    <!-- Konten halaman -->
    <canvas id="canvasEl" width="800" height="600"></canvas>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fabric@latest/dist/fabric.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const canvasEl = document.getElementById('canvasEl');
            const canvas = new fabric.Canvas(canvasEl);

            fabric.Object.prototype.set({
                cornerStyle: 'rect',
                cornerStrokeColor: 'blue',
                cornerColor: 'lightblue',
                padding: 10,
                transparentCorners: false,
                cornerDashArray: null,
                borderColor: 'blue',
                borderDashArray: null,
                borderScaleFactor: 2,
            });

            const text = new fabric.Text('Masukkan teks di sini', {
                left: 100,
                top: 100,
                fill: 'black'
            });

            canvas.add(text);
            canvas.centerObject(text);
            canvas.setActiveObject(text);
        });
    </script>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>adijawdjiwaijdi</h1>
    @yield('content')
    <h1>Rayhan</h1>
    <script src="https://cdn.jsdelivr.net/npm/fabric@latest/dist/fabric.min.js"></script>
    @yield('scripts')
</body>
</html>