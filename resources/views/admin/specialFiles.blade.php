<style>
    .data{
        float: left;
        padding: 10px;
        margin: 10px;
        width: 80%;
        background-color: #EEEEEE;
    }
    .data-button{
        float: right;
        padding: 9px;
        margin: 10px;
        width: 10%;
    }
</style>


@foreach($filenames as $item)
    <div class="file-item">
        <div class="data">
            {{ $item }}
        </div>
        <a class="btn btn-primary data-button" name="del" data-name="{{ $item }}">
            <span class="oi oi-circle-x"></span>
        </a>        
    </div>
@endforeach