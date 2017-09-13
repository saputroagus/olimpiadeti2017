@extends('la.layouts.app')

@section('htmlheader_title')
    Forbidden !
@endsection

@section('contentheader_title')
    403 Error Page
@endsection

@section('$contentheader_description')
@endsection

@section('main-content')

<div class="error-page">
    <h2 class="headline text-yellow"> 403</h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Forbidden to access</h3>
        <p>
            You can't change your information
            Meanwhile, you may <a href="javascript:history.back()">go back</a> to the previous page.
        </p>
    </div><!-- /.error-content -->
</div><!-- /.error-page -->
@endsection