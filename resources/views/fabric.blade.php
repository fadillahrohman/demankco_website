<!DOCTYPE html> 
<html> 

<head> 
	<!-- Adding the FabricJS library -->
	<script src= 
"https://cdnjs.cloudflare.com/ajax/libs/fabric.js/3.6.2/fabric.min.js"> 
	</script> 
</head> 

<body> 

     {{-- Canvasnya --}}
	<canvas id="canvas-bg" width="720" height="720"
		style="border:1px solid blue"> 
	</canvas> 

	<script> 
		// Background
		let canvas = new fabric.Canvas("canvas-bg", { 
			backgroundImage: "{{ asset('images/base_mockup.png') }}" 
		});

        // Editor objek
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

          // Teks
          const text = new fabric.Text('Masukkan teks di sini', {
              left: 100,
              top: 100,
              fill: 'black'
          });

        //   fungsi
          canvas.add(text);
          canvas.centerObject(text);
          canvas.setActiveObject(text);
	</script> 
</body> 

</html> 
