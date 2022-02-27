<button @if(isset($form)) form="{{$form}}" @endif  id="{{isset($id) ? $id : "submit"}}" type="{{isset($type) ? $type : "submit"}}" class="{{isset($class_name) ? $class_name : "btn btn-flat primary_btn float-right navbar-orange"}}">{{isset($name) ? $name : "Submit"}}</button>
<style>
    .primary_btn:hover{
        background-color: #007bff;
    }

</style>
