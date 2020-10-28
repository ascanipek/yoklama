@extends('layouts.appold')
<script src="//code.jquery.com/jquery-1.11.1.js"></script>
@section('content')
<div class="container">
      <div class="alert alert-light" role="alert">
        Hoşgeldiniz, <span class="text-success"> {{ Auth::user()->name }},</span>
        <span>
            İdareci olarak giriş yaptınız
            ama size atanmış derslerin yoklamasını girmek istiyorsanız aşağıdan öğretmen paneline ulaşabilirsiniz.
            <br> Yönetim paneline ulaşmak için İdareci Paneli butonunu kullanın.
        </span>
    </div>
    <div class="row justify-content-center">
        
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span style="float:left;">Seçim Yapın</span>
                    <span style="float: right; font-weight: 700; color: red;"></span>
                </div>
                <div class="card-body">
                        <div class="list-group">
                            <a class="btn btn-primary mb-3" href="/yoklama">Öğretmen Paneli</a>
                            <a class="btn btn-secondary" href="/adminpanel">İdareci Paneli</a>
                        </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


{{-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> --}}
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>


{{-- <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> --}}


