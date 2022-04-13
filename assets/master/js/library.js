// $("#kode_satuan").focus();


document.onkeydown = function (event) {
    // alert(event.keyCode);
    switch (event.keyCode) {
    
        case 40:

            // $(".kode_tipe").focus();

            let a = $(".active").val();
            
            if( a == 2 ){

                console.log("satu");
                
                $(".dua").click();

                $("#kode_tipe").focus();
                
                $(".val1").removeClass("kuis");
                $(".val2").addClass("kuis");
                $(".satu").removeClass("active");
                $(".tiga").removeClass("active");
                $(".enam").removeClass("active");
                $(".lima").removeClass("active");

                $(".dua").addClass("active");
                $(".satu-show").removeClass("active");
                $(".dua-show").addClass("show active ");
                
                // $("#form-2").focus();

                
            }else if(a == 3){
                // console.log(a);

                console.log("dua");
                // $(".kode_tipe").focus();
                
                // $("#dua3").click();
                $(".tiga").click();
                $(".val2").removeClass("kuis");
                $(".val3").addClass("kuis");
                $(".dua").removeClass("active");
                $(".tiga").addClass("active");
                $(".dua-show").removeClass("active");
                $(".tiga-show").addClass("show active ");

                // $("#form-3").focus();

                
                
            }else if (a == 4 ){
                $(".empat").click();
                // console.log(a);
                console.log("tiga");
                
                // $("#dua4").click();
                $(".val3").removeClass("kuis");
                $(".val4").addClass("kuis");
                $(".tiga").removeClass("active");
                $(".empat").addClass("active");
                $(".tiga-show").removeClass("active");
                $(".empat-show").addClass("show active ");
                // $(".btn-selesai-5").removeClass("selesai");
                // $("#form-4").focus();
                
                
            }else if (a == 5){
                
                $(".lima").click();
                // console.log(a);/
                
                console.log("empat");

                // $("#dua5").click();
                $(".val4").removeClass("kuis");
                $(".val5").addClass("kuis");
                $(".empat").removeClass("active");
                $(".lima").addClass("active");
                $(".empat-show").removeClass("active");
                $(".lima-show").addClass("show active ");
                // $("#form-5").focus();
                
            }else if( a == 6 ){
                $(".enam").click();
                
                
                // console.log(a);
                console.log("lima");

                    // $("#dua1").click();
                    $(".val5").removeClass("kuis");
                    $(".val6").addClass("kuis");
                    $(".lima").removeClass("active");
                    $(".enam").addClass("active");
                    $(".lima-show").removeClass("active");
                    $(".enam-show").addClass("show active ");
                    // $("#form-1").focus();

          
            }else if ( a == 7){
                console.log("lima");
                
                $(".satu").click();
                // console.log(a);
                $(".val6").removeClass("kuis");
                $(".val1").addClass("kuis");
                $(".enam").removeClass("active");
                $(".satu").addClass("active");
                $(".enam-show").removeClass("active");
                $(".satu-show").addClass("show active ");
                $(".lima").removeClass("active");

                
            }

            event.preventDefault();
            break;

             
            
         
      
    }
 }


    // event.preventDefault();
    // teziger.preventDefault();


