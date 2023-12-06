<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editor de Blocos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
  </head>
  <body>

    <div class="container text-center">
      <div class="row pt-4">
          <div class="col-sm-8 col-md-8 col-lg-12 m-auto">
          @yield('content')
          </div>
      </div>
    </div>


    <script>

        function updateBlockJson(){
            block = {};
            block.text = document.getElementById('text').value;
            block.image = document.getElementById('image').value;
            block.options = [];

            $('.field_options').each( function(optionIndex){
                if(optionIndex == 0){return;}
                option = {};
                option.value = $(this).find('.field_option_select').first().val();
                option.text = $(this).find('.field_option_text').first().val();
                block.options[optionIndex-1] = option;
            });        

            document.getElementById('body').value = JSON. stringify(block);

            console.log(block);
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

        function removeOption(el){
            formOptionClass = $(el).attr('formOptionClass');
            $('.'+formOptionClass).remove();
            updateBlockJson();
        }

        //Helper function
        function uniqId() {
            var uniqid = Math.random().toString(16).slice(2);
            return uniqid;
        }

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
  </body>
</html>