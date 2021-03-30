@if ($rShow)
    <a href="{{route($rShow, $data->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-right mr-2"></i> Selengkapnya</a>  
@endif

@if ($rDel)
<form class="form-{{$data->id}}" method="POST" action="{{ route($rDel, $data->id) }}" onsubmit="return confirm('Anda yakin ingin menghapus data ini?')">
    @method('DELETE')
    @csrf

    
    @if ($rFile)
        <a href="{{route($rFile, $data->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-download mr-2"></i> Download</a>  | 
    @endif

    @if ($rEdit)
        <a href="{{route($rEdit, $data->id)}}" class="btn btn-sm btn-info"><i class="fas fa-edit mr-2"></i> Ubah</a>  | 
    @endif
    
        <button type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-trash mr-2"></i> Hapus</button>	
    
        
</form>
@endif