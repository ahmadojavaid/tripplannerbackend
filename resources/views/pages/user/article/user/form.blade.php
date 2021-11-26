<div class="form-body">
  <div class="row">
    <div class="col-12">
      {{Form::fieldText('title')}}
    </div>
    <div class="col-12">
      {{Form::fieldText('sub_title')}}
    </div>
    <div class="col-12">
      {{Form::fieldTextEditor('description')}}
    </div>
    <div class="col-12">
      {{Form::fieldSelect('category_id' ,  $categoryArr)}}
    </div>
    <div class="col-12">
      {{Form::fieldSelect('status' ,  $statusArr)}}
    </div>
    <div class="col-12">
      {{Form::fieldSelect('priority_status' ,  $priorityStatusArr)}}
    </div>
    <div class="col-12">
      {{Form::fieldSelect2('tags[]' ,$tagArr,null,"Select tags",['multiple'=>"multiple" ])}}
    </div>
    <div class="col-12">
      {{Form::fieldFile('photo')}}
    </div>
  </div>
</div>

@push('page-script')
<script>
  $('document').ready(function(){

    const modules = {
      formula: true,
      syntax: true,
      toolbar: [
        [
          {
            font: []
          },
          {
            size: []
          }
        ],
        ["bold", "italic", "underline", "strike"],
        [
          {
            color: []
          },
          {
            background: []
          }
        ],
        [
          {
            script: "super"
          },
          {
            script: "sub"
          }
        ],
        [
          {
            header: "1"
          },
          {
            header: "2"
          },
          "blockquote",
          "code-block"
        ],
        [
          {
            list: "ordered"
          },
          {
            list: "bullet"
          },
          {
            indent: "-1"
          },
          {
            indent: "+1"
          }
        ],
        [
          "direction",
          {
            align: []
          }
        ],
        // ["link", "image", "video", "formula"],
        ["clean"]
      ]
    };
    var quillEditor = new Quill("#editor-description.quill-editor", {
      bounds: ".quill-editor",
      modules: {...modules},
      theme: "snow"
    });

    var name = document.querySelector('input[name=description]'); // set name input var
    $(document).on('submit' , 'form' , function(){
      name.value = quillEditor.getText().trim().length !== 0 ?
        JSON.stringify(quillEditor.getContents()) : ""; // populate name input with quill data
      return true; // submit form
    });
    if(name.value.length!==0)
    quillEditor.setContents(JSON.parse(name.value));

  });

</script>
@endpush
