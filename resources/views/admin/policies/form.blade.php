


{!! \App\MyHelper\Field::text('title' , 'العنوان ' ) !!}


<textarea class="ckeditor form-control" name="content">{{ $model->content  }}  </textarea>




@push('scripts')

    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
@endpush
