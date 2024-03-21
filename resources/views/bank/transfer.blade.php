@extends('layouts.master')
@section('styles')
<style>
    .home-container{
        background: #a1a1a117;
    height: 100vh;
    width: auto;

    }
    .home-wrapper{
        display: flex;
    justify-content: center;
    align-items: center;
    height:100vh;
    }

    .home-wrapper ul{
        list-style: none;
    padding: 50px;
    box-shadow: 1px 0px 20px #d1c7c7;
    }

    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
.transfer-wrapper{
    margin-top:20px;
    width:100%;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50vh;
  

}
.card-header h1{
    font-size: 14px;
}
</style>
@endsection
@section('content')
<div class="transfer-wrapper">
<div class="card mt-4">
        <div class="card-header">
            <h1>Transfer Money</h1>
        </div>
        <div class="card-body">
            <div class="form-group">
                <input type="number" class="form-control" name="amount" id="amount" placeholder="enter amount..." min=1>
                <label for="" class="text-danger" id="amountError"></label>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="email" id="email" placeholder="enter email..." min=1>
                <label for="" class="text-danger" id="emailError"></label>
            </div>
         
            <input type="submit" value="submit" class="btn btn-primary  btn-wdrw">
        </div>
    </div>
</div>
    
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on('click','.btn-wdrw',function()
    {
        let amount=$("#amount").val();
        let email=$("#email").val();
           
            Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, do it!"
            }).then((result) => {

            $.ajax({
                url:"{{route('transfer.submit')}}",
                type:"post",
                data:{'_token':'{{csrf_token()}}','amount':amount,'email':email},
                success:function(data)
                {
                    if (data.status) {
                            Swal.fire({
                            title: "transfered!",
                            text: "Your amount transfered successfully.",
                            icon: "success"
                            }).then(()=>{
                                location.href="{{route('home')}}";
                            });
                        }
                        else{
                            if(data.validationErrors)
                            {
                                
                                Object.keys(data.validationErrors).forEach((value)=>{
                                   
                                  $("#"+value+"Error").text(data.validationErrors[value][0])
                            })
                              
                            }
                            else{
                                Swal.fire({
                                title: "Error!",
                                text: data.message,
                                icon: "error"
                                }).then(()=>{
                                    location.reload();
                                });
                            }
                        }
                },
                error:function(data)
                {
                    Swal.fire({
                            title: "Error!",
                            text:"something went wrong",
                            icon: "error"
                            }).then(()=>{
                                location.reload();
                            });
                }
            });
            
            });
      
       
    });

    $(document).on('keyup','#amount',function()
    {
        $("#amntError").text('');
    });

    $(document).on('keyup','#email',function()
    {
        $("#emailError").text('');
    });
</script>
@endsection
