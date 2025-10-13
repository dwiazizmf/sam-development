@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.detailDocumentClaim.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.detail-document-claims.update", [$detailDocumentClaim->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="insurance_company_id">{{ trans('cruds.detailDocumentClaim.fields.insurance_company') }}</label>
                <select class="form-control select2 {{ $errors->has('insurance_company') ? 'is-invalid' : '' }}" name="insurance_company_id" id="insurance_company_id">
                    @foreach($insurance_companies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('insurance_company_id') ? old('insurance_company_id') : $detailDocumentClaim->insurance_company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('insurance_company'))
                    <span class="text-danger">{{ $errors->first('insurance_company') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.detailDocumentClaim.fields.insurance_company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="insurance_product_id">{{ trans('cruds.detailDocumentClaim.fields.insurance_product') }}</label>
                <select class="form-control select2 {{ $errors->has('insurance_product') ? 'is-invalid' : '' }}" name="insurance_product_id" id="insurance_product_id">
                    @foreach($insurance_products as $id => $entry)
                        <option value="{{ $id }}" {{ (old('insurance_product_id') ? old('insurance_product_id') : $detailDocumentClaim->insurance_product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('insurance_product'))
                    <span class="text-danger">{{ $errors->first('insurance_product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.detailDocumentClaim.fields.insurance_product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="policies_data_id">{{ trans('cruds.detailDocumentClaim.fields.policies_data') }}</label>
                <select class="form-control select2 {{ $errors->has('policies_data') ? 'is-invalid' : '' }}" name="policies_data_id" id="policies_data_id">
                    @foreach($policies_datas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('policies_data_id') ? old('policies_data_id') : $detailDocumentClaim->policies_data->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('policies_data'))
                    <span class="text-danger">{{ $errors->first('policies_data') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.detailDocumentClaim.fields.policies_data_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="claim_type_id">{{ trans('cruds.detailDocumentClaim.fields.claim_type') }}</label>
                <select class="form-control select2 {{ $errors->has('claim_type') ? 'is-invalid' : '' }}" name="claim_type_id" id="claim_type_id">
                    @foreach($claim_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('claim_type_id') ? old('claim_type_id') : $detailDocumentClaim->claim_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('claim_type'))
                    <span class="text-danger">{{ $errors->first('claim_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.detailDocumentClaim.fields.claim_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="claims_id">{{ trans('cruds.detailDocumentClaim.fields.claims') }}</label>
                <select class="form-control select2 {{ $errors->has('claims') ? 'is-invalid' : '' }}" name="claims_id" id="claims_id">
                    @foreach($claims as $id => $entry)
                        <option value="{{ $id }}" {{ (old('claims_id') ? old('claims_id') : $detailDocumentClaim->claims->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('claims'))
                    <span class="text-danger">{{ $errors->first('claims') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.detailDocumentClaim.fields.claims_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_document_claim">{{ trans('cruds.detailDocumentClaim.fields.file_document_claim') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_document_claim') ? 'is-invalid' : '' }}" id="file_document_claim-dropzone">
                </div>
                @if($errors->has('file_document_claim'))
                    <span class="text-danger">{{ $errors->first('file_document_claim') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.detailDocumentClaim.fields.file_document_claim_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="assigned_to_user_id">{{ trans('cruds.detailDocumentClaim.fields.assigned_to_user') }}</label>
                <select class="form-control select2 {{ $errors->has('assigned_to_user') ? 'is-invalid' : '' }}" name="assigned_to_user_id" id="assigned_to_user_id">
                    @foreach($assigned_to_users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('assigned_to_user_id') ? old('assigned_to_user_id') : $detailDocumentClaim->assigned_to_user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('assigned_to_user'))
                    <span class="text-danger">{{ $errors->first('assigned_to_user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.detailDocumentClaim.fields.assigned_to_user_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.fileDocumentClaimDropzone = {
    url: '{{ route('admin.detail-document-claims.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="file_document_claim"]').remove()
      $('form').append('<input type="hidden" name="file_document_claim" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file_document_claim"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($detailDocumentClaim) && $detailDocumentClaim->file_document_claim)
      var file = {!! json_encode($detailDocumentClaim->file_document_claim) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file_document_claim" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection