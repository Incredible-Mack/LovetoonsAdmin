@extends('layout')

@section('style')
    <style>
        #video-container {
            position: absolute;
            right: 0;
            bottom: 0;
            z-index: 1;
            clear: both;
            width: 640px;
            /* Set your custom width */
            height: 360px;

            display: none;
        }


        @media (max-width:500px) {
            #video-container {
                width: 100%;
            }
        }

        #video-container .videoplayer {
            width: 90%;
            height: 100%;
            padding: 0;
            margin: 0;

        }

        #video-container .closed {
            color: red;
            margin-left: -100px;
            cursor: pointer;
            font-weight: bold;
            font-size: 30px;
            float: right;
            clear: both;
            margin-top: -50px;
            margin-right: 10px;
            background: #f6d5d5;
            padding-top: 3px;
            z-index: 2;
            width: 50px;
            height: 50px;
            text-align: center;
            border-radius: 50%
        }
    </style>
@endsection

@section('breadcrumb')
    <x-heading heading="Manage Videos" links='' />
@endsection

@section('maincontent')
    <!-- Navbar -->


    <div class="card">

        <!-- /.card-header -->
        <div class="card-body">

            <div class="alert alert-danger d-none alert-dismissible fade show error" role="alert">
                <strong>Not Successfully</strong> Video could not be deleted please try again later
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="alert alert-success d-none  alert-dismissible fade show success" role="alert">
                <strong>Success</strong> Video Successfully Deleted
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Bible Chapter</th>
                        <th>Image</th>
                        <th>Preview Video</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($videos as $video)
                        <tr id='tablerow{{ $video['id'] }}'>
                            <td>{{ $video['fullname'] }} </td>
                            <td>{{ $video['biblechapter'] }}</td>
                            <td> <img src="{{ url($video['image']) }}" width='200' height='150'> </td>
                            <td onclick="playVideo('{{ $video['link'] }}')">{{ $video['link'] }}</td>
                            <td>
                                <button data-toggle="modal" data-target="#modal-default" data-itemid="{{ $video['id'] }}"
                                    class="btn btn-danger m-1 deleteBtn"> <i class="fas fa-trash"></i> Delete</button>

                                <button onclick="window.location.href='editvideo/{{ $video['id'] }}'"
                                    class="btn btn-warning m-1 d-block"> <i class="fas fa-edit"></i> EDIT</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>


            <div id="video-container">
                <div class="closed" onclick="stopVideoPlaying()">X</div>
                <video id="video-player" width='400' height="200" controls class="videoplayer">
                    Your browser does not support the video tag.
                </video>
            </div>


            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="modal-default" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this video </p>

                            <button class="btn btn-danger btnconfirmation" data-confirm="true"> Yes </button>
                            <button class="btn btn-success btnconfirmation" data-confirm="false" data-dismiss="modal"> NO
                            </button>

                        </div>

                    </div>
                </div>
            </div>

            

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection

@section('script')
    <!-- DataTables  & ../Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->



    <script>
        $(document).ready(function() {
            var itemId, confirm;
            $(".deleteBtn").click(function() {
                itemId = $(this).data('itemid')
            })

            $(".btnconfirmation").click(function() {
                confirm = $(this).data('confirm')
                if (confirm === true) {
                    $.ajax({
                        url: 'deletevideo',
                        method: 'post',
                        data: {
                            'id': itemId
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            
                            $('#modal-default').modal('hide');


                            if(data.message !== 'Failed'){
                                $('#tablerow'+ itemId).addClass('d-none')
                                $('.success').removeClass('d-none')
                            }else{
                                $('.error').removeClass('d-none')
                            }

                            setTimeout(() => {
                                $('.success').addClass('d-none')
                                $('.error').addClass('d-none')
                            }, 2500);

                        }
                    })
                }
            })



        })
    </script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        function playVideo(videoLink) {
            // Set the video source and play
            document.getElementById('video-player').src = videoLink;
            document.getElementById('video-player').play();

            // Show the video container
            document.getElementById('video-container').style.display = 'block';
        }

        function stopVideoPlaying() {
            var videoPlayer = document.getElementById('video-player');
            var videoContainer = document.getElementById('video-container');

            videoPlayer.pause();

            videoContainer.style.display = 'none';
        }
    </script>
@endsection
