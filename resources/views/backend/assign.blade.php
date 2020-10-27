@extends('adminlte::page')

@section('title', 'Yoklama Yönetim Paneli')

@section('content_header')
    <h1 class="ml-2"> Ders Atama </span></h1>
@stop

@section('content')
    <div class="container-fluid">
        {{-- @foreach ($classes as $item)
           sınıf: {{ $item->class }} <br>
           şube: {{ $item->branch }} <br>
           alan: {{ $item->department }}
        @endforeach --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-primary">
                      <h3 class="card-title">Sınıf Ekle</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <select class="form-control" id="cls">
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
                                    <select class="form-control" id="lesson">
                                        <option selected value="0">Ders Seçin</option>
                                        @foreach ($lessons as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <select class="form-control" id="teacher">
                                        <option selected value="0">Öğretmen Seçin</option>
                                        @foreach ($teachers as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="day" type="checkbox" id="mon" value="mon">
                                    <label class="form-check-label" for="mon">Pazartesi</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="day" type="checkbox" id="tue" value="tue">
                                    <label class="form-check-label" for="tue">Salı</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="day" type="checkbox" id="wen" value="wen">
                                    <label class="form-check-label" for="wen">Çarşamba</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="day" type="checkbox" id="thu" value="thu">
                                    <label class="form-check-label" for="thu">Perşembe</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="day" type="checkbox" id="fri" value="fri">
                                    <label class="form-check-label" for="fri">Cuma</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="day" type="checkbox" id="sat" value="sat">
                                    <label class="form-check-label" for="sat">Cumartesi</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="day" type="checkbox" id="sun" value="sun">
                                    <label class="form-check-label" for="sun">Pazar</label>
                                </div>
                            </div>
                        </div> 
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <button id="add" class="btn btn-danger btn-block">Kaydet</button>
                            </div>
                        </div> 
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-primary">
                      <h3 class="card-title">Ders Programı</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-striped" id="schedule">
                        <thead>
                          <tr>
                            <th>Sınıf</th>
                            <th>Şube</th>
                            <th>Ders</th>
                            <th>Öğretmen</th>
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
              <h5 class="modal-title" id="exampleModalLabel">Ders Güncelle</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="update">
                    
                        <div class="form-group">
                            <select class="form-control" id="clsUp">
                              <option value="0">Sınıf Seçin</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="branchUp">
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
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="lessonUp">
                                <option selected value="0">Ders Seçin</option>
                                @foreach ($lessons as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="teacherUp">
                                <option selected value="0">Öğretmen Seçin</option>
                                @foreach ($teachers as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="dayUp" type="checkbox" id="monUp" value="mon">
                                    <label class="form-check-label" for="monUp">Pazartesi</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="dayUp" type="checkbox" id="tueUp" value="tue">
                                    <label class="form-check-label" for="tueUp">Salı</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="dayUp" type="checkbox" id="wenUp" value="wen">
                                    <label class="form-check-label" for="wenUp">Çarşamba</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="dayUp" type="checkbox" id="thuUp" value="thu">
                                    <label class="form-check-label" for="thuUp">Perşembe</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="dayUp" type="checkbox" id="friUp" value="fri">
                                    <label class="form-check-label" for="friUp">Cuma</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="dayUp" type="checkbox" id="satUp" value="sat">
                                    <label class="form-check-label" for="satUp">Cumartesi</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="dayUp" type="checkbox" id="sunUp" value="sun">
                                    <label class="form-check-label" for="sunUp">Pazar</label>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group mt-3">
                            <button class="btn btn-primary btn-block" id="updateButton">Kaydet</button>
                        </div>
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
@stop

@section('js')
  <script src="//code.jquery.com/jquery-1.11.1.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.js') }}"></script>
  <script src="/vendor/sweetalert2/sweetalert2.min.js"></script>
  <script src="/vendor/sweetalert2/sweetalert2.all.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
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

    const Move = Swal.mixin({
        title: 'Dur!',
        text: 'Bir derse iki öğretmen atayamazsınız... Önce diğer ders kaydını silin ve tekrar atama yapın...',
        icon: 'warning',
        // showCancelButton: true,
        // cancelButtonText: 'Vazgeç',
        // confirmButtonText: 'Taşı',
    })

    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var _token = $('input[name="_token"]').val();
        
        // let week = ['mon', 'tue', 'wen', 'thu', 'fri', 'sat', 'sun']
        let checkDays = []
        let checkDaysUp = []
        let id
        let mon = 0, tue = 0, wen = 0, thu = 0, fri = 0, sat = 0, sun = 0
        let monUp = 0, tueUp = 0, wenUp = 0, thuUp = 0, friUp = 0, satUp = 0, sunUp = 0
        fetch_data()

        $(document).on('change', 'input:checkbox[name=day]', function(){
           
            $("input:checkbox[name=day]:checked").each(function(){
                checkDays.push($(this).val());
                // console.log($(this).val())
            }); 
            checkDays.map((item) => {
                if(item == 'mon') mon = 1
                else if(item == 'tue') tue = 1
                else if(item == 'wen') wen = 1
                else if(item == 'thu') thu = 1
                else if(item == 'fri') fri = 1
                else if(item == 'sat') sat = 1
                else if(item == 'sun') sun = 1
            })
        })

        $(document).on('click', '#add', function(){
            let cls = $('#cls').val()
            let branch = $('#branch').val()
            let lesson = $('#lesson').val()
            let teacher = $('#teacher').val()
            if(cls == 0 || branch == 0 || lesson == 0 || teacher == 0){
                Do.fire({
                        toast: false,
                        position: 'center',
                        icon: 'warning',
                        text: 'Lütfen tüm seçimleri yapın!',   
                })
            }
            else{
                // console.log(mon, tue, wen, thu, fri, sat, sun)
                $.ajax({
                    url: "{{ route('addAssign') }}",
                    method: 'post',
                    data:{
                        cls: cls,
                        branch: branch,
                        lesson: lesson,
                        teacher: teacher,
                        mon: mon, tue: tue, wen: wen, thu: thu, fri: fri, sat: sat, sun: sun,
                        _token: _token
                    },
                    success:function(data){
                        console.log(data)
                        if(data == 'isFull'){
                            Move.fire({
                            })
                        }
                        else{
                            $('#cls').val(0)
                            $('#branch').val(0)
                            $('#lesson').val(0)
                            $('#teacher').val(0)
                            $('input:checkbox[name=day]').removeAttr('checked');
                            Do.fire({
                                icon: 'warning',
                                title: 'Ders, sınıf, öğretmen ve gün ataması yapıldı',   
                            })
                            setTimeout(() => {
                                location.reload()
                            },300)
                            fetch_data()
                        }
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
                            url:"{{ route('delAssign') }}",
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

        // checkbox her değiştiğinde diziyi/değişkenleri doldur
        $(document).on('change', 'input:checkbox[name=dayUp]', function(){
            monUp = 0; tueUp = 0; wenUp = 0; thuUp = 0; friUp = 0; satUp = 0; sunUp = 0;
            checkDaysUp = []
            $("input:checkbox[name=dayUp]:checked").each(function(){
                checkDaysUp.push($(this).val());
            }); 
            checkDaysUp.map((item) => {
                if(item == 'mon') monUp = 1
                else if(item == 'tue') tueUp = 1
                else if(item == 'wen') wenUp = 1
                else if(item == 'thu') thuUp = 1
                else if(item == 'fri') friUp = 1
                else if(item == 'sat') satUp = 1
                else if(item == 'sun') sunUp = 1
            })
        })

        $(document).on('click', '.edit', function(){
            monUp = 0; tueUp = 0; wenUp = 0; thuUp = 0; friUp = 0; satUp = 0; sunUp = 0;
            let cls
            let branch
            let lesson
            let teacher
            $("#clsUp").val($(this).attr('data-class'));
            $("#branchUp").val($(this).attr('data-branch'));
            $("#lessonUp").val($(this).attr('data-lesson'));
            $("#teacherUp").val($(this).attr('data-teacher'));
            id = $(this).attr('data-id');
            let days = ($(this).attr('data-days')).split(',');
            $('input:checkbox[name=dayUp]').removeAttr('checked');
            checkDaysUp = []
            for(let i = 0; i < days.length; i++){
                if(i == 0 && days[i] == 1){
                    $("#monUp").prop('checked', true)
                }
                else if(i == 1 && days[i] == 1){
                    $("#tueUp").prop('checked', true)
                }
                else if(i == 2 && days[i] == 1){
                    $("#wenUp").prop('checked', true)
                }
                else if(i == 3 && days[i] == 1){
                    $("#thuUp").prop('checked', true)
                }
                else if(i == 4 && days[i] == 1){
                    $("#friUp").prop('checked', true)
                }
                else if(i == 5 && days[i] == 1){
                    $("#satUp").prop('checked', true)
                }
                else if(i == 6 && days[i] == 1){
                    $("#sunUp").prop('checked', true)
                }
            }
            // modal ilk açıldığında da ilk kez diziyi/değişkenleri doldur
            // checkDaysUp = []
            $("input:checkbox[name=dayUp]:checked").each(function(){
                checkDaysUp.push($(this).val());
            }); 
            checkDaysUp.map((item) => {
                if(item == 'mon') monUp = 1
                else if(item == 'tue') tueUp = 1
                else if(item == 'wen') wenUp = 1
                else if(item == 'thu') thuUp = 1
                else if(item == 'fri') friUp = 1
                else if(item == 'sat') satUp = 1
                else if(item == 'sun') sunUp = 1
            })

            $(document).on('click', '#updateButton', function(e){
                e.preventDefault()
                let cls = $('#clsUp').val()
                let branch = $('#branchUp').val()
                let lesson = $('#lessonUp').val()
                let teacher = $('#teacherUp').val()
                if(cls == 0 || branch == 0 || lesson == 0 || teacher == 0){
                    Do.fire({
                        toast: false,
                        position: 'center',
                        icon: 'warning',
                        text: 'Lütfen tüm seçimleri yapın!',   
                    })
                }
                else{
                    // console.log(mon, tue, wen, thu, fri, sat, sun)
                    $.ajax({
                        url: "{{ route('updateAssign') }}",
                        method: 'post',
                        data:{
                            id: id,
                            cls: cls,
                            branch: branch,
                            lesson: lesson,
                            teacher: teacher,
                            mon: monUp, tue: tueUp, wen: wenUp, thu: thuUp, fri: friUp, sat: satUp, sun: sunUp,
                            _token: _token
                        },
                        success:function(data){
                            console.log(data)
                            $('#clsUp').val(0)
                            $('#branchUp').val(0)
                            $('#lessonUp').val(0)
                            $('#teacherUp').val(0)
                            $('input:checkbox[name=dayUp]').removeAttr('checked');
                            $("#exampleModal").modal('toggle');
                            // fetch_data()
                            Do.fire({
                                icon: 'success',
                                title: 'Ders, sınıf, öğretmen ve gün bilgileri güncellendi',   
                            })
                            setTimeout(() => {
                                location.reload()
                            },300)
                        } // end success func
                    })
                }
            })
            console.log(days)
        })
        
        function fetch_data(){
            $.ajax({ 
                url:"{{ route('fetchAssign') }}",
                dataType:"json",
                success:function(data){
                    console.log(data)
                    $('#schedule').DataTable( {
                        data: data,
                        columns: [
                            { data: 'class' },
                            { data: 'branch' },
                            { data: 'lesson' },
                            { data: 'teacher' },
                            { data: 'edit' },
                            { data: 'delete' }
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
                        }
                    } );
                } // end of success func
            }); // end of ajax call

        } // end fetch 
    })

  </script>
@stop