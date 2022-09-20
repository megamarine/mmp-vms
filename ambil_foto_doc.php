<!doctype html>
<html>
<head>
    <?php include "module/model/head/head.php"; ?>
    <style>
        input {margin-top: 10px;}
    </style>
</head>
<body>
    <div class="row">
        <div align="center" style="font-size: 15pt;"><strong>.: DOCUMENT PIC :.</strong></div>
        <div id="camera">Capture</div>
        <br>
        <div id="webcam" align="center">
            <button onClick="preview()" class="btn btn-primary btn-block btn-lg"><i class="fas fa-camera fa-lg"></i></button>
        </div>
        <div id="simpan" style="display:none">
            <div class="btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <button onClick="batal()" class="btn btn-danger btn-lg"><i class="fas fa-trash fa-lg"></i></button>
                </div>
                <div class="btn-group" role="group">
                    <button onClick="simpan()" class="btn btn-primary btn-lg"><i class="fas fa-check fa-lg"></i></button>
                </div>
            </div>
        </div>
    </div>
    
    
    <script src="assets/webcam/webcam.min.js"></script>
    <script language="Javascript">
        // konfigursi webcam
        Webcam.set({
            width: 740,
            height: 400,
            image_format: 'jpg',
            force_flash: false,
            jpeg_quality: 100,
            flip_horiz: true
        });
        
        Webcam.attach( '#camera' );
 
        function preview() {
            Webcam.freeze();
            document.getElementById('webcam').style.display = 'none';
            document.getElementById('simpan').style.display = '';
        }
        
        function batal() {
            Webcam.unfreeze();
            document.getElementById('webcam').style.display = '';
            document.getElementById('simpan').style.display = 'none';
        }
        
        function simpan() {
            Webcam.snap( function(data_uri) 
            {    
                Webcam.upload( data_uri, 'upload_doc.php', function(code, text) {
                    if(code === 200){
                    alert("Photo has been taken!");
                    window.close();
                  }
                } );
            } );
        }
    </script>
    
</body>
</html>