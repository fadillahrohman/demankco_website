@section('content')
    <!-- Konten halaman -->
    <canvas id="canvasEl" width="800" height="600"></canvas>
@endsection

@section('scripts')
    <script src="{{ asset('js/fabric.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const canvasEl = document.getElementById('canvasEl');
            const canvas = new fabric.Canvas(canvasEl);

            fabric.Object.prototype.set({
                cornerStyle: 'circle',
                cornerStrokeColor: 'blue',
                cornerColor: 'lightblue',
                padding: 10,
                transparentCorners: false,
                cornerDashArray: [2, 2],
                borderColor: 'orange',
                borderDashArray: [3, 1, 3],
                borderScaleFactor: 2,
            });

            const text = new fabric.Text('Fabric.JS');
            const rect = new fabric.Rect({ width: 100, height: 100, fill: 'green' });

            canvas.add(text, rect);
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
    <script src="https://cdn.jsdelivr.net/npm/fabric@latest/dist/index.min.js"></script>
    <script>
        const { StaticCanvas, FabricText } = fabric;
        const canvas = new StaticCanvas();
        const helloWorld = new FabricText('Hello world!');
        canvas.add(helloWorld);
        canvas.centerObject(helloWorld);
        const imageSrc = canvas.toDataURL();
        // some download code down here
        const a = document.createElement('a');
        a.href = imageSrc;
        a.download = 'image.png';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    </script>
</body>
@yield('scripts')
</html>