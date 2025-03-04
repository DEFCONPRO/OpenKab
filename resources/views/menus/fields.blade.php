<!-- Name Field -->
<div class="form-group row">
    <div class="col-12">
    {!! Form::text('text', null, ['class' => 'form-control item-menu', 'maxlength' => 255, 'placeholder' => 'Nama Menu']) !!}
    {!! Form::hidden('icon', 'fas fa-list', ['class' => 'item-menu']) !!}
    </div>
</div>

<!-- Asal url -->
<div class="form-group row">
    <div class="col-12">
        <label class="form-check-inline">
            {!! Form::radio('source', 'link', 'link', ['class' => 'form-check-input']) !!} Link
        </label>
        <label class="form-check-inline">
            {!! Form::radio('source', 'Halaman', null, ['class' => 'form-check-input']) !!} Halaman
        </label>
        <label class="form-check-inline">
            {!! Form::radio('source', 'Kategori', null, ['class' => 'form-check-input']) !!} Kategori
        </label>
        <label class="form-check-inline">
            {!! Form::radio('source', 'Modul', null, ['class' => 'form-check-input']) !!} Modul
        </label>
    </div>
</div>

<!-- Url Field -->
<div class="form-group row">
    <div class="col-12">
    {!! Form::select('sourcelist', $sourceItem, null, ['class' => 'form-control']) !!}
    {!! Form::text('href', null, ['class' => 'form-control item-menu', 'maxlength' => 255, 'placeholder' => 'http://contoh.com']) !!}
    </div>
</div>

@push('js')
<script nonce="{{  csp_nonce() }}">
	document.addEventListener("DOMContentLoaded", function(event) {
        $('select[name=sourcelist]').hide()
        $(':radio[name=source]').change(function(){
            let _val = $(this).val()
            $('input[name=href]').val('')
            $('input[name=href]').hide()
            $('select[name=sourcelist]').hide()
            switch(_val){
                case 'Kategori':
                case 'Halaman':
                case 'Modul':
                    $('select[name=sourcelist]').show()
                    $('select[name=sourcelist]').find('optgroup').hide()
                    $('select[name=sourcelist]').find('optgroup[label="'+_val+'"]').show()
                    $('select[name=sourcelist]').find('optgroup[label="'+_val+'"]').find('option:first').prop('selected', 1)
                    $('select[name=sourcelist]').trigger('change')
                    break;
                default:
                    $('input[name=href]').show()
            }
        })

        $('select[name=sourcelist]').on('change', function(){
            $('input[name=href]').val($(this).val())
        })
    })
</script>
@endpush
