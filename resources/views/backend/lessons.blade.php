@extends('adminlte::page')

@section('title', 'Yoklama Yönetim Paneli')

@section('content_header')
    <h1 class="ml-2"> Ders Tanımlama </span></h1>
@stop

@section('content')
    <div class="container-fluid">
        {{-- @foreach ($classes as $item)
           sınıf: {{ $item->class }} <br>
           şube: {{ $item->branch }} <br>
           alan: {{ $item->department }}
        @endforeach --}}
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-primary">
                      <h3 class="card-title">Ders Ekle</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-3">
                            <div class="form-group">
                                <label for="department">Ders Adı</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <button class="btn btn-primary btn-block" id="add">Kaydet</button>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-primary">
                      <h3 class="card-title">Ders Listesi</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Ders Adı</th>
                            <th>Güncelle</th>
                            <th>Sil</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
            </div>
        </div>
      
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ders Güncelle</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="update">
                    <div class="form-group">
                        <label for="lessonUp">Ders Adı</label>
                        <input class="form-control" type="text" id="lessonUp">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" id="updateButton">Kaydet</button>
                </form>
            </div>
          </div>
        </div>
      </div>

  

    {{ csrf_field() }}

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <link href="/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet">
@stop

@section('js')
  <script src="//code.jquery.com/jquery-1.11.1.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.js') }}"></script>
  <script src="/vendor/sweetalert2/sweetalert2.min.js"></script>
  <script src="/vendor/sweetalert2/sweetalert2.all.min.js"></script>

  <script> 
    const Do = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        // dangerMode: true
        // type: 'info'
    });

    const DoFire = Swal.mixin({
        // toast: true,
        position: 'center',
        showConfirmButton: true,
        confirmButtonText: 'Sil',
        showCancelButton: true,
        cancelButtonText: 'Hayır',
        // timer: 3000,
        dangerMode: true
        // type: 'info'
    });
    
    const Del = Swal.mixin({
        title: 'Emin misiniz?',
        text: 'Bu sınıf silincektir! Tabi ki daha sonra ekleyebilirsiniz :)',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Vazgeç',
        confirmButtonText: 'Sil',
    })

    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var _token = $('input[name="_token"]').val();

        fetch_data()

        $(document).on('click', '#add', function(){
            let lesson = $('#name').val().trim()
            if(lesson == '' || lesson == ' ' || lesson == null){
                Do.fire({
                        toast: false,
                        position: 'center',
                        icon: 'warning',
                        text: 'BOŞ Yapma!',   
                })
            }
            else{
                $.ajax({
                    url: "{{ route('addLesson') }}",
                    method: 'post',
                    data:{
                        lesson: lesson,
                        _token: _token
                    },
                    success:function(data){
                        $('#name').val('')
                        Do.fire({
                            icon: 'success',
                            title: 'Ders eklendi',   
                        })
                        fetch_data()
                        } // end success func
                    })
            }
        })

        $(document).on('click', '.delete', function(){
            // console.log($(this).attr('data-id'))
            let id = $(this).attr('data-id')
                Del.fire().then(function(isSure){
                        if(isSure.value){
                            // console.log(isSure)
                            $.ajax({
                            url:"{{ route('delLesson') }}",
                            method:"POST",
                            data:{id:id, _token:_token},
                            success:function(data){
                                // $('#message').html(data);
                                Do.fire({
                                        icon: 'warning',
                                        title: 'Ders silindi.',   
                                })
                                // silme işleminden sonra tekrar sırala
                                fetch_data();
                                } // end success 
                            }) // end ajax
                        } // end if
                    }); // end then 
        })    

        $(document).on('click', '.update', function(){
            $('#lessonUp').val($(this).attr('data-lesson'))
            let id = $(this).attr('data-id')

            $('#update').on('submit', function(e){
                e.preventDefault()
                let lesson = $('#lessonUp').val().trim()
                if(lesson == ' ' || lesson == null || lesson == '  ' || lesson == ''){
                    Do.fire({
                        toast: false,
                        position: 'center',
                        icon: 'warning',
                        text: 'BOŞ Yapma!',   
                    })
                }
                else{
                    $.ajax({
                        url: "{{ route('updateLesson') }}",
                        method: 'post',
                        data:{
                            id: id,
                            lesson: lesson,
                            _token: _token
                        },
                        success:function(data){ 
                            console.log(data)
                            Do.fire({
                                icon: 'success',
                                title: 'Ders Bilgileri Güncellendi',   
                            })
                            // $('#exampleModal').modal('hide')
                            setTimeout(() => {
                                location.reload()
                            },300)
                            fetch_data()
                        } // end success func
                    })
                }
            })
        })
            
        

        function fetch_data(){
            $.ajax({ 
                url:"{{ route('fetchLessons') }}",
                dataType:"json",
                success:function(data){
                    console.log(data)
                    var html = ''
                    for(var count=0; count < data.length; count++){
                        html += '<tr>';
                            html += '<td>' + data[count].name + '</td>';
                            html += '<td> <button class="update btn btn-success btn-sm" data-lesson="' + data[count].name + '" data-toggle="modal" data-target="#exampleModal" data-id="' + data[count].id +'">Düzenle</button></td>';
                            html += '<td> <button class="delete btn btn-danger btn-sm" data-id="' + data[count].id +'">X</button></td>';
                        html += '</tr>'    
                    }
                    $('tbody').html(html);
                } // end of done func
            }); // end of ajax call
        } // end fetch 
    })
 
  </script>
@stop