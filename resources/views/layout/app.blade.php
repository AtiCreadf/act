<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ACT - @yield('titulo')</title>

    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    {{-- <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}"> --}}
    {{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
    <script src="https://cdn.tiny.cloud/1/v2shm7n6e1cp295z30v6flm7quxscqdkgggm70gh9xb3xl3h/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    {{-- <script src="{{ asset('js/tinymce.min.js') }}" referrerpolicy="origin"></script> --}}
    <script>
        tinymce.init({
          selector: '#tinymce',
          menubar: true,
          setup : function(ed) {
            ed.on('keydown', function(event) {
                if (event.keyCode == 9) { // tab pressed
                    ed.execCommand('mceInsertContent', false, '&emsp;&emsp;'); // inserts tab
                    event.preventDefault();
                    return false;
                }
                if (event.keyCode == 32) { // space bar
                    if (event.shiftKey) {
                        ed.execCommand('mceInsertContent', false, '&hairsp;'); // inserts small space
                        event.preventDefault();
                        return false;
                    }
                }
            });
        },
        plugins: [
            'advlist',
            // 'advtable',
            'autolink',
            // 'checklist',
            'lists',
            'charmap',
            'preview',
            'searchreplace',
            // 'powerpaste',
            'fullscreen',
            'insertdatetime',
            'table',
            'help',
            'wordcount'
        ],
        language: 'pt_BR',
        toolbar: 'fullscreen preview | fontfamily fontsize | undo redo | casechange blocks | bold italic backcolor | table | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist checklist outdent indent | help |'
        });
      </script>
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed" oncontextmenu="return false">
    {{-- <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
    </div> --}}

    @include('layout.components.header')
    @include('layout.components.nav')

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid d-flex justify-content-start flex-column">
                @yield('conteudo')
            </div>
        </section>
    </div>


    @include('layout.components.footer')

    @if (env('APP_ENV') != 'local')
        {{-- <script>
            if (document.addEventListener) {
                document.addEventListener("contextmenu", function(e) {
                    e.preventDefault();
                    return false;
                });
            } else { //Versões antigas do IE
                document.attachEvent("oncontextmenu", function(e) {
                    e = e || window.event;
                    e.returnValue = false;
                    return false;
                });
            }
        </script> --}}
   
    @endif
   
    <!-- jQuery -->
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    {{-- <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script> --}}
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script> --}}
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
    {{-- <script>
        $(function () {
            // Summernote
            $('#summernote').summernote({
                height: 250,
                tabDisable: true,
                toolbar: [
                    ['fontsize', ['fontsize']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['style', ['style']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen']],
                    ['help', ['help']]
                ],
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']]
                    ],
                    link: [
                        ['link', ['linkDialogShow', 'unlink']]
                    ],
                    table: [
                        ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                        ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                    ],
                    air: [
                        ['color', ['color']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['para', ['ul', 'paragraph']],
                        ['table', ['table']],
                        
                        ['insert', ['link', 'picture']]
                    ]
                }
            })
      
        })
    </script> --}}
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>    
    
    <script>
        // $('.select2').select2()
        
        //Initialize Select2 Elements
        $('.select2').select2({
            theme: 'bootstrap4',
            tags: true,
            tokenSeparators: [","],
        })
       
        /* console.log($('.select2'))
        @isset(Auth::user()->id)
            notificacoes({{ Auth::user()->id }}, '{{ env("APP_URL") }}');
        @endisset
 */
        
    </script>

    @include('layout.components.ui.alerts')
    
</body>
</html>