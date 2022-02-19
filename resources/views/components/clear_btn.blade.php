<button type="button" class="btn btn-flat btn-success primary_btn float-right">Clear</button>
<style>
    .primary_btn:hover{
        background-color: #007bff;
    }

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('.btn-success').on('click',function(){
            document.getElementById("myForm").reset();
        })
    });
</script>
