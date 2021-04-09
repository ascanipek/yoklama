@extends('adminlte::page')

@section('title', 'Yoklama Yönetim Paneli')

@section('content_header')
    <h1 class="ml-2"> Öğretmen Tanımlama </span></h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-primary">
                      <h3 class="card-title">Öğretmen Ekle</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-3">
                        <form id="form">
                            <div class="form-group">
                                <label for="branch">Branş</label>
                                <select class="form-control" id="branch" required>
                                  <option value="0">Branş Seçin</option>
                                  <option value="BİLİŞİM TEKNOLOJİLERİ">BİLİŞİM TEKNOLOJİLERİ</option>
                                  <option value="ELEKTRİK ELEKTRONİK">ELEKTRİK ELEKTRONİK</option>
                                  <option value="RTV">RTV</option>
                                  <option value="GAZETECİLİK">GAZETECİLİK</option> 
                                  <option value="BEDEN EĞİTİMİ">BEDEN EĞİTİMİ</option>
                                  <option value="BİYOLOJİ">BİYOLOJİ</option> 
                                  <option value="COĞRAFYA">COĞRAFYA</option> 
                                  <option value="DİN KÜLTÜRÜ VE AHLAK BİLGİSİ">DİN KÜLTÜRÜ VE AHLAK BİLGİSİ</option> 
                                  <option value="FELSEFE">FELSEFE</option> 
                                  <option value="FİZİK">FİZİK</option> 
                                  <option value="GÖRSEL SANATLAR">GÖRSEL SANATLAR</option> 
                                  <option value="KİMYA">KİMYA</option> 
                                  <option value="MATEMATİK">MATEMATİK</option> 
                                  <option value="EDEBİYAT">EDEBİYAT</option> 
                                  <option value="TARİH">TARİH</option> 
                                  <option value="İNGİLİZCE">İNGİLİZCE</option> 
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">İsim Soyisim</label>
                                <input class="form-control" type="text" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">E-Posta</label>
                                <input class="form-control" aria-describedby="emailHelp" type="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="pass">Parola</label>
                                <input class="form-control" type="password" id="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" id="add">Kaydet</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-primary">
                      <h3 class="card-title">Öğretmen Listesi</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>İsim</th>
                            <th>E-Posta</th>
                            <th>Branş</th>
                            <th>Düzenle</th>
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
              <h5 class="modal-title" id="exampleModalLabel">Bilgi Güncelle</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="update">
                    <div class="form-group">
                        <label for="branchUp">Branş</label>
                        <select class="form-control" id="branchUp" required>
                          <option value="0">Branş Seçin</option>
                          <option value="Bilişim Teknolojileri">Bilişim Teknolojileri</option>
                          <option value="Elektrik Elektronik">Elektrik Elektronik</option>
                          <option value="RTV">RTV</option>
                          <option value="Gazetecilik">Gazetecilik</option>  
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nameUp">İsim Soyisim</label>
                        <input class="form-control" type="text" id="nameUp" required>
                    </div>
                    <div class="form-group">
                        <label for="emailUp">E-Posta</label>
                        <input class="form-control" aria-describedby="emailHelp" type="email" id="emailUp" required>
                    </div>
                    <div class="form-group">
                        <label for="passwordUp">Şifre</label>
                        <input class="form-control" type="password" id="passwordUp" required>
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

        $(document).on('submit', '#form', function(e){
            e.preventDefault();
            let name = $('#name').val().trim()
            let branch = $('#branch').val().trim()
            let email = $('#email').val().trim()
            let password = $('#password').val()
            if(branch == 0){
                Do.fire({
                        toast: false,
                        position: 'center',
                        icon: 'warning',
                        text: 'Branş seçilmeli!',   
                })
            }
            else if(password.length < 6){
                Do.fire({
                        toast: false,
                        position: 'center',
                        icon: 'warning',
                        text: 'Şifre en az 6 karakter olmak zorundadır!',   
                })
            }
            else{
                $.ajax({
                    url: "{{ route('addTeacher') }}",
                    method: 'post',
                    data:{
                        name: name,
                        branch: branch,teachers.blade.php
                        email: email,
                        yetki: 2,
                        password: password,
                        _token: _token
                    },
                    success:function(data){
                        if(data == 'email var!'){
                            console.log(data)
                            Do.fire({
                                toast: false,
                                position: 'center', 
                                icon: 'warning',
                                text: 'E-Posta adresi veritabanında kayıtlı!',   
                            })
                        }
                        else{
                            console.log(data)
                            $('#name').val('')
                            $('#branch').val('')
                            $('#email').val()
                            $('#password').val('')
                            Do.fire({
                                icon: 'success',
                                title: 'Öğretmen eklendi',   
                            })
                            fetch_data()
                        }  
                    } // end success func
                    })
            }
            // console.log(cls, branch, dep)


        })

        $(document).on('click', '.delete', function(){
            // console.log($(this).attr('data-id'))
            let id = $(this).attr('data-id')
                Del.fire().then(function(isSure){
                        if(isSure.value){
                            // console.log(isSure)
                            $.ajax({
                            url:"{{ route('delTeacher') }}",
                            method:"POST",
                            data:{id:id, _token:_token},
                            success:function(data){
                                // $('#message').html(data);
                                Do.fire({
                                        icon: 'warning',
                                        title: 'Öğretmen silindi.',   
                                })
                                // silme işleminden sonra tekrar sırala
                                fetch_data();
                                } // end success 
                            }) // end ajax
                        } // end if
                    }); // end then 
        })
        
        $(document).on('click', '.edit', function(){
            //$(this).attr('data-id')
            $('#nameUp').val($(this).attr('data-name'))
            $('#branchUp').val($(this).attr('data-branch'))
            $('#emailUp').val($(this).attr('data-email'))
            let id = $(this).attr('data-id')
            $('#update').on('submit', function(e){
                e.preventDefault()
                let name = $('#nameUp').val().trim()
                let branch = $('#branchUp').val().trim()
                let email = $('#emailUp').val().trim()
                let password = $('#passwordUp').val()
                if(branch == 0){
                    Do.fire({
                        toast: false,
                        position: 'center',
                        icon: 'warning',
                        text: 'Branş seçilmeli!',   
                    })
                }
                else if(password.length < 6){
                    Do.fire({
                        toast: false,
                        position: 'center',
                        icon: 'warning',
                        text: 'Şifre en az 6 karakter olmak zorundadır!',   
                    })
                }
                else{
                    $.ajax({
                        url: "{{ route('updateTeacher') }}",
                        method: 'post',
                        data:{
                            id: id,
                            name: name,
                            branch: branch,
                            email: email,
                            password: password,
                            _token: _token
                        },
                        success:function(data){ 
                            console.log(data)
                            Do.fire({
                                icon: 'success',
                                title: 'Öğretmen Bilgileri Güncellendi',   
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
                url:"{{ route('fetchTeachers') }}",
                dataType:"json",
                success:function(data){
                    console.log(data)
                    var html = ''
                    for(var count=0; count < data.length; count++){
                        html += '<tr>';
                            html += '<td>' + data[count].name + '</td>';
                            html += '<td>'+ data[count].email + '</td>';
                            html += '<td>'+ data[count].branch + '</td>';
                            html += '<td> <button class="edit btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal" data-name="' + data[count].name + '" data-email="' + data[count].email + '" data-branch="' + data[count].branch + '" data-id="' + data[count].id +'">Düzenle</button></td>';
                            html += '<td> <button class="delete btn btn-danger btn-sm" data-id="' + data[count].id +'">X</button></td>';
                        html += '</tr>'    
                    }
                    $('tbody').html(html);
                } // end of done func
            }); // end of ajax call
        } // end fetch 
    })
    // <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button>
  </script>
@stop