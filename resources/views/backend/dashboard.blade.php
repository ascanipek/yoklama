@extends('adminlte::page')

@section('title', 'Yoklama Yönetim Paneli')

@section('content_header')
    <h1 class="ml-2"> Yoklama </span></h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-teal">
                        Gün bazında tüm veriler
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="dateOne">Tarih Seçin</label>
                                    <input type="date" class="form-control" id="dateOne">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="getOne">&nbsp;</label>
                                <button id="getOne" class="btn btn-block btn-success" disabled>Getir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-purple">
                       Sınıf, gün ve ders bazında veriler.
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="class">Sınıf</label>
                                    <select class="form-control" id="class">
                                        <option value="0">Sınıf Seçin</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="branch">Şube</label>
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
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="date">Tarih Seçin</label>
                                    <input type="date" class="form-control" id="date">
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="get">&nbsp;</label>
                                <button id="get" class="btn btn-block btn-success" disabled>Getir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="result">
          
        </div>
        <div class="row" id="tableResult" style="visibility: hidden;">
            <div class="col-12 p-0">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped" id="res">
                            <thead>
                              <tr>
                                <th>Sınıf</th>
                                <th>Ders</th>
                                <th>Öğretmen</th>
                                <th>Gelmeyen Öğrenciler</th>
                                <th>Toplam</th>
                                <th>Katılım Oranı</th>
                                <th>Yoklama Saati</th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- <ul>
            <li>Sadece tarih seçtirerek o günün yoklaması girilen derslerin sayısal verilerini getir.</li>
            <li>Sınıf, gün ve ders bazlı gelmeyen öğrencilerin listesini dataTables ile ver excel veya pdf e aktarılsın.</li>
        </ul> --}}
    </div>


  

    {{ csrf_field() }}

@stop

{{-- 
    
    
    
    
    
    
    
    
       
--}}

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
    
    {{-- <link href="/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet"> --}}
@stop

@section('js')
  {{-- <script src="//code.jquery.com/jquery-1.11.1.js"></script> --}}
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js "></script>

  {{-- <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script> --}}
  {{-- <script src="{{ asset('vendor/bootstrap/js/bootstrap.js') }}"></script> --}}
  <script src="/vendor/sweetalert2/sweetalert2.min.js"></script>
  <script src="/vendor/sweetalert2/sweetalert2.all.min.js"></script>

  <script> 

    const Do = Swal.mixin({
        // toast: true,
        // position: 'top-end',
        showConfirmButton: false,
        timer: 500,
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

        // Birinci filtre
        $(document).on('change', '#dateOne', function(){
            $('#getOne').attr("disabled", false);
        })
    
        $(document).on('click', '#getOne', function(){
            let date = $('#dateOne').val()
            // bu tarihi backende gönderip 
            $.ajax({ 
                url:"{{ route('getDateBase') }}",
                // dataType:"json",
                data:{
                    date: date,
                    _token: _token
                },
                success:function(data){
                    console.log(data)
                    if(data.length != 0){
                        html =''
                        data.map(item => {
                            html += '<div class="col-md-3 col-sm-6 col-12"><div class="info-box bg-danger"><span class="info-box-icon">'
                            html += item.class
                            html += '</span><div class="info-box-content"><span class="info-box-text">'+ item.lesson +'</span><span style="font-size:12px;" class="info-box-text">'+ item.teacher + ' - ' + item.saveTime  +'</span><span class="info-box-number">'
                            html += 'Gelen: ' + item.heres + ' - Gelmeyen: ' + item.notHere + '</span>'
                            html += '<div class="progress"><div class="progress-bar" style="width: '+ item.rate +'%"></div></div>'
                            html += '<span class="progress-description">% ' + item.rate + ' Katılım</span></div></div></div>'
                        })
                        // $('#result').html(html)
                        // $('#result').animate({'opacity': 0}, 200, function(){
                        //     $(this).html(html).animate({'opacity': 1}, 200);    
                        // });
                        $('#res').css('visibility', 'hidden')
                        $('#tableResult').css('visibility', 'hidden')
                        $("#result").fadeOut(300, function() {
                            $(this).html(html).fadeIn(300);
                        });
                    }
                    else{
                        Do.fire({
                            text: 'Kayıt bulunamadı...',
                            timer: 1000,
                            icon: 'warning'
                        })
                        // console.log('kayıt yok')
                    }
                   
                } // end of done func
            }); // end of ajax call
        })

        // ikinci filtre
        $(document).on('change', '#date', function(){
            $('#get').attr("disabled", false);
        })

        $(document).on('click', '#get', function(){
            let date = $('#date').val()
            let cls = $('#class').val()
            let branch = $('#branch').val()
            // bu tarihi backende gönderip 
            if(cls == 0 || branch == 0){
                Do.fire({text: 'Sınıf ve Şube Seçin!'})
            }
            else{
                $.ajax({ 
                    url:"{{ route('getLessonBase') }}",
                    // dataType:"json",
                    data:{
                        date: date,
                        cls: cls,
                        branch: branch,
                        _token: _token
                    },
                    success:function(data){
                        if(data.length != 0){
                            console.log(data)
                            $('#result').html('')
                            $('#res').css('visibility', 'visible')
                            $('#tableResult').css('visibility', 'visible')
                            $('#res').DataTable( {
                                data: data,
                                columns: [
                                    { data: 'class' },
                                    { data: 'lesson' },
                                    { data: 'teacher' },
                                    { data: 'gelmeyenler' },
                                    { data: 'notHere' },
                                    { data: 'rate' },
                                    { data: 'saveTime'}
                                ],
                                responsive: true,
                                "bDestroy": true,
                                "pageLength": 25,
                                "language": {
                                    "lengthMenu": "Her sayfada _MENU_ kayıt göster",
                                    "zeroRecords": "Kayıt bulunamadı",
                                    "info": " _PAGE_ / _PAGES_",
                                    "infoEmpty": "Gösterilecek kayıt yok",
                                    "infoFiltered": "(filtered from _MAX_ total records)",
                                    "search": "Ara",
                                    "paginate": {
                                        "previous": "Önceki Sayfa",
                                        "next": "Sonraki Sayfa"
                                    }
                                },
                                dom: 'Bfrtip',
                                buttons: [
                                    {extend: 'copy', text: 'Kopyala'},
                                    {extend: 'pdf', text: 'PDFye Dönüştür'},
                                    {extend: 'print', text: 'Yazdır'}
                                ],
                            }); // end dataTable
                        }
                        else{
                            // console.log('kayıt yok')
                            Do.fire({
                                text: 'Kayıt bulunamadı...',
                                timer: 1000,
                                icon: 'warning'
                            })
                        }
                    } // end of done func
                }); // end of ajax call
            }
            
        })
    })
  </script>
@stop