@extends('adminlte::page')

@section('title', 'Yoklama Yönetim Paneli')

@section('content_header')
    <h1 class="ml-2"> Sınıf Tanımlama </span></h1>
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
                      <h3 class="card-title">Sınıf Ekle</h3>
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
                                <label for="department">Bölüm</label>
                                <select class="form-control" id="department">
                                    <option selected value="0">Alan Seçin</option>
                                    <option value="Bilişim Teknolojileri">Bilişim Teknolojileri</option>
                                    <option value="Elektrik Elektronik">Elektrik Elektronik</option>
                                    <option value="Radyo Televizyon">Radyo Televizyon</option>
                                    <option value="Gazetecilik">Gazetecilik</option>
                                  </select>
                                {{-- <input type="text" class="form-control" id="department" placeholder="Örn: Bilişim Teknolojileri"> --}}
                            </div>
                            <div class="form-group">
                                <label for="department">Okul Türü</label>
                                <select class="form-control" id="tur">
                                    <option selected value="0">Tür Seçin</option>
                                    <option value="AMP">AMP</option>
                                    <option value="ATP">ATP</option>
                                  </select>
                                {{-- <input type="text" class="form-control" id="department" placeholder="Örn: Bilişim Teknolojileri"> --}}
                            </div>
                            <button class="btn btn-primary btn-block" id="add">Kaydet</button>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-primary">
                      <h3 class="card-title">Sınıf Listesi</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Sınıf</th>
                            <th>Şube</th>
                            <th>Alan</th>
                            <th>Tür</th>
                            <th>Sınıfa Listesi</th>
                            <th>Düzenle</th>
                            <th>Sil</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($classes as $item)
                                <tr>
                                    <td>{{ $item->class }}</td>
                                    <td>{{ $item->branch }}</td>
                                    <td>{{ $item->department }}</td>
                                    <td>{{ $item->tur }}</td>
                                    <td><button class="btn btn-success btn-sm edit" data-id="{{ $item->id }}">Düzenle</button></td>
                                    <td><button class="btn btn-danger btn-sm delete" data-id="{{ $item->id }}">X</button></td>
                                </tr>
                            @endforeach
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
            let cls = $('#cls').val()
            let branch = $('#branch').val()
            let dep = $('#department').val()
            let tur = $('#tur').val()
            if(dep == 0 || tur == 0){
                Do.fire({
                        toast: false,
                        position: 'center',
                        icon: 'warning',
                        text: 'Alan ve Okul Türü bilgileri boş bırakılamaz!',   
                })
            }
            else{
                $.ajax({
                    url: "{{ route('addClass') }}",
                    method: 'post',
                    data:{
                        cls: cls,
                        branch: branch,
                        dep: dep,
                        tur: tur,
                        _token: _token
                    },
                    success:function(data){
                        // console.log(data)
                        // $('#cls').val('')
                        // $('#branch').val('')
                        // $('#department').val('')
                        Do.fire({
                            icon: 'success',
                            title: 'Sınıf eklendi',   
                        })
                        fetch_data()
                        } // end success func
                    })
            }
            console.log(cls, branch, dep)


        })

        $(document).on('click', '.delete', function(){
            // console.log($(this).attr('data-id'))
            let id = $(this).attr('data-id')
                Del.fire().then(function(isSure){
                        if(isSure.value){
                            // console.log(isSure)
                            $.ajax({
                            url:"{{ route('delClass') }}",
                            method:"POST",
                            data:{id:id, _token:_token},
                            success:function(data){
                                // $('#message').html(data);
                                Do.fire({
                                        icon: 'warning',
                                        title: 'Sınıf silindi.',   
                                })
                                // silme işleminden sonra tekrar sırala
                                fetch_data();
                                } // end success 
                            }) // end ajax
                        } // end if
                    }); // end then 
        })

        $(document).on('click', '.edit', function(){
            console.log($(this).attr('data-id'))
        })
        

        

        function fetch_data(){
            $.ajax({ 
                url:"{{ route('fetchClass') }}",
                dataType:"json",
                success:function(data){
                    console.log(data)
                    var html = ''
                    for(var count=0; count < data.length; count++){
                        html += '<tr>';
                            html += '<td>' + data[count].class + '</td>';
                            html += '<td>'+ data[count].branch + '</td>';
                            html += '<td>'+ data[count].department + '</td>';
                            html += '<td>'+ data[count].tur + '</td>';
                            html += '<td> <button class="get btn btn-primary btn-sm" data-id="' + data[count].id +'">Sınıfa Git</button></td>';
                            html += '<td> <button class="edit btn btn-success btn-sm" data-id="' + data[count].id +'">Düzenle</button></td>';
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