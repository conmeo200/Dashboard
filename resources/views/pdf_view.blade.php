<!DOCTYPE html>
<html>
<head>
    <title>PDF Example</title>
    <script src="{{URL::asset('js/BO/validateForm.js')}}"></script>
    <script src="{{URL::asset('js/BO/jquery.min.js')}}"></script>
</head>
<style>
    .h1 {
        color: red;
    }

    .p{
        color: blue;
    }
</style>
<body>
@include('shared.componentBO.form')
</body>
</html>
