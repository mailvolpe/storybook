@extends('blocks.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Bloco
                </div>
                <div class="float-end">
                    <a href="{{ route('blocks.index') }}" class="btn btn-primary btn-sm">&larr; Voltar</a>
                </div>
            </div>
            <div class="card-body" id="blocks_card">



            </div>
        </div>
    </div>    
</div>

<script>

    document.addEventListener("DOMContentLoaded", function(event) {
        addBlock(<?=$block->id?>);
    });

    allBlocks = <?=$all_blocks?>;

    function addBlock(id, textString){

        if(!textString){textString = "";}

        optionsString = "";
        $(allBlocks[id].options).each(function(){

            if(!!allBlocks[this.value]){
                optionsString = optionsString+ "<a class=\"btn m-2 btn-outline-secondary\" href=\"javascript:void(0)\" onclick=\"addBlock("+this.value+", \'"+this.text+"\'); $(this).parent().hide();\">"+this.text+" - "+this.value+"</a>&nbsp;"
            }else{
                optionsString = optionsString+" <a class=\"btn m-2 btn-primary disabled\">"+this.text+"&nbsp; <i class=\"text-danger bi bi-exclamation-diamond\"></i></a>&nbsp;"
            }

        })
        
        document.getElementById("blocks_card").insertAdjacentHTML("beforeend",
            "<div class=\"row\">"+
                "<div class=\"col\">"+
                    "<p>"+textString+"</p>"+
                    "<div class=\"my-3\"><img src=\""+allBlocks[id].image+"\" width=\"200px\"></div>"+
                    "<p>"+allBlocks[id].text+"</p>"+
                    "<div class=\"my-3\">"+optionsString+"</div>"+
                "</div>"+
            "</div>"
        );

    }

    function addOption(optionValue){
          
          //Cloning
          formOption_copy = $('.originalFieldOption').clone();
          formOption_copy.removeClass('originalFieldOption');
          formOption_copy.removeClass('d-none');
          //console.log(formOption_copy);

          //Add Unique Class & Append
          newFormOptionClass = uniqId()+'_FormFieldOption';
          formOption_copy.addClass(newFormOptionClass);                
          formOption_copy = formOption_copy.appendTo('.fieldOptionsList');

          //Adds attr formOptionClass (option identifier) to elements
          $('.'+newFormOptionClass).find('.removeOptionButton').each( function(index){ 
              $(this).attr('formOptionClass', newFormOptionClass); 
          } );

          //Sets option value
          if(optionValue){
              $('.'+newFormOptionClass+' .field_option').val(optionValue);
              updateBlockJson();
          }

          return newFormOptionClass;
      }

</script>
@endsection