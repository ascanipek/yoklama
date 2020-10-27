@extends('adminlte::page')

@section('title', 'Yoklama Yönetim Paneli')

@section('content_header')
    <h1 class="ml-2"> Öğrenci Ekleme </span></h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-primary">
                      <h3 class="card-title">Öğrenci Ekle</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-3">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Sınıf</label>
                                <select class="form-control" id="cls">
                                  <option value="0">Sınıf Seçin</option>
                                  <option value="9">9</option>
                                  <option value="10">10</option>
                                  <option value="11">11</option>
                                  <option value="12">12</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Şube</label>
                                <select class="form-control" id="branch">
                                  <option value="0">Şube Seçin</option>
                                  <option value="A">A</option>
                                  <option value="B">B</option>
                                  <option value="C">C</option>
                                  <option value="D">D</option>
                                  <option value="E">E</option>
                                  <option value="F">F</option>
                                  <option value="G">G</option>
                                  <option value="H">H</option>
                                  <option value="I">I</option>
                                  <option value="K">K</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Okul Numarası</label>
                                <input type="text" class="form-control" id="number" placeholder="Örn. : 1453">

                            </div>
                            
                            <button class="btn btn-primary btn-block" id="add">Kaydet</button>
                        
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-primary">
                      <h3 class="card-title">Öğrenci Listesi</h3>
                      <div class="card-tools" >
                        <span id="info"></span>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Sınıf</th>
                            <th>Şube</th>
                            <th>Numara</th>
                            <th>Düzenle</th>
                            <th>Sil</th>
                          </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($classes as $item)
                                <tr>
                                    <td>{{ $item->class }}</td>
                                    <td>{{ $item->branch }}</td>
                                    <td>{{ $item->department }}</td>
                                    <td>{{ $item->tur }}</td>
                                    <td><button class="btn btn-success btn-sm edit" data-id="{{ $item->id }}">Düzenle</button></td>
                                    <td><button class="btn btn-danger btn-sm delete" data-id="{{ $item->id }}">X</button></td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
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
    // sınıf ve şube seçildiğinde sınıf listesi alanını doldursun
    // sonra yeni öğrenciyi eklesin
    // düzenleme burada mutlaka olsun
    // düzenleme özellikle sınıf değişikliklerinde olsun
    // ama aynı numaralı öğrenci başka sınıfta varsa buraya taşırken sorsun!


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

    const Move = Swal.mixin({
        title: 'Emin misiniz?',
        text: 'Bu öğrenci başka bir sınıfta kayıtlıdır! Bu sınıfa taşımak mı istiyorsunuz?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Vazgeç',
        confirmButtonText: 'Taşı',
    })
    
    const Del = Swal.mixin({
        title: 'Emin misiniz?',
        text: 'Bu öğrenci silincektir! Tabi ki daha sonra ekleyebilirsiniz :)',
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
        //fetch_data(cls, branch)


        $(document).on('change', '#branch', function(){
          let cls = $('#cls').val()
          let branch = $('#branch').val()
          fetch_data(cls, branch)
        })

        $(document).on('click', '#add', function(){
          let cls = $('#cls').val()
          let branch = $('#branch').val()
          let number = $('#number').val().trim()
          if(cls == 0 || branch == 0 || number == '' || number == ' ' || number == null){
                Do.fire({
                        toast: false,
                        position: 'center',
                        icon: 'warning',
                        text: 'Lütfen tüm bilgileri doldurun!',   
                })
          }
          else{
            $.ajax({
              url: "{{ route('saveStudents') }}",
              method: 'post',
              data:{
                  type: 1,
                  cls: cls,
                  branch: branch,
                  number: number,
                  _token: _token
              },
              success:function(data){
                console.log(data)
                if(data != 0){
                  Do.fire({
                      icon: 'success',
                      title: 'Öğrenci eklendi',   
                  })
                  fetch_data(cls, branch)
                  $('#number').val('')
                }
                else{
                  Move.fire().then(function(isSure){
                    if(isSure.value){
                      $.ajax({
                        url: "{{ route('saveStudents') }}",
                        method: 'post',
                        data:{
                            type: 2,
                            cls: cls,
                            branch: branch,
                            number: number,
                            _token: _token
                        },
                        success:function(data){
                          Do.fire({
                            icon: 'success',
                            title: 'Öğrenci bu sınıfa taşındı',   
                          })
                          fetch_data(cls, branch)
                          $('#number').val('')
                        }
                      })
                    }
                    
                  })
                }
              } // end success func
            })
          }
        })

        $(document).on('click', '.delete', function(){
          let cls = $('#cls').val()
          let branch = $('#branch').val()
          let id = $(this).attr('data-id')
          Del.fire().then(function(isSure){
            if(isSure.value){
                // console.log(isSure)
                $.ajax({
                url:"{{ route('delStudent') }}",
                method:"POST",
                data:{id:id, _token:_token},
                success:function(data){
                    // $('#message').html(data);
                    Do.fire({
                            icon: 'warning',
                            title: 'Öğrenci silindi.',   
                    })
                    // silme işleminden sonra tekrar sırala
                    fetch_data(cls, branch);
                    } // end success 
                }) // end ajax
              } // end if
            }); // end then 
        })


        function fetch_data(cls, branch){
            $.ajax({ 
                url:"{{ route('fetchStudents') }}",
                data: { 
                  cls: cls,
                  branch: branch,
                  _token: _token
                },
                dataType:"json",
                success:function(data){
                    //console.log(data)
                      let info = data.info
                      data = data.data
                      var html = ''
                      for(var count=0; count < data.length; count++){
                          html += '<tr>';
                              html += '<td>' + data[count].class + '</td>';
                              html += '<td>'+ data[count].branch + '</td>';
                              html += '<td>'+ data[count].number + '</td>';
                              html += '<td> <button class="edit btn btn-success btn-sm" data-id="' + data[count].id +'">Düzenle</button></td>';
                              html += '<td> <button class="delete btn btn-danger btn-sm" data-id="' + data[count].id +'">X</button></td>';
                          html += '</tr>'    
                      }
                      $('tbody').html(html);
                      $('#info').html(cls + branch + '-' + info[0].department + ' / ' + info[0].tur);
                  
                  

                } // end of done func
            }); // end of ajax call
        } // end fetch 
    })

  </script>
@stop