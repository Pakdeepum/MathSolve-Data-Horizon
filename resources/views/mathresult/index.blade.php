@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col10">
        <h1> HIER + GIBT + ES = NEUES </h1>
        </div>
        <div class="col-2">
            <button class="trigger btn btn-success text-light"> Get result </button>
            <!--Delete Medal-->
            <div class="modal" id="ajax-crud-modal">
                <div class="modal-content"><span class="btn-close">&times;</span>
                    <form method="post" action="{{url('math')}}">
                        <p></p>
                        <h3 class="text-success text-center">Calculate</h3>
                        <p></p>
                        <div class="form-group row">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="value1" class="col-sm-3 col-form-label">value1</label>
                                <div class="col-sm-9">
                                    <input disabled name="value1" type="string" class="form-control" id="value1" 
                                        placeholder="value1" value="HIER" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="value2" class="col-sm-3 col-form-label">value2</label>
                                <div class="col-sm-9">
                                    <input disabled name="value2" type="string" class="form-control" id="value2"
                                        placeholder="value2" value="GIBT" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="value3" class="col-sm-3 col-form-label">value3</label>
                                <div class="col-sm-9">
                                    <input disabled name="value3" type="string" class="form-control" id="value3"
                                        placeholder="value3" value="ES" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="result" class="col-sm-3 col-form-label">result</label>
                                <div class="col-sm-9">
                                    <input disabled name="result" type="string" class="form-control" id="result"
                                        placeholder="result" value="NEUES" autocomplete="off">
                                </div>
                            </div>
                            <div class="offset-sm-4 col-sm-9">
                                <button type="submit" class="btn btn-success text-light">Confirm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <p> </p>

    <table class="table table-bordered" >
        <tr class="bg-dark">
            <th>
                <p class="text-light text-center"> HIER </p>
            </th>
            <th>
                <p class="text-light text-center"> GIBT </p>
            </th>
            <th>
                <p class="text-light text-center"> ES </p>
            </th>
            <th>
                <p class="text-light text-center"> NEUES </p>
            </th>
            <th>
                <p class="text-light text-center"> Action </p>
            </th>
        </tr>

        @if(count($res)>0)
            @foreach($res as $math)
                <tr>
                    <td>{{$math->value1}}</td>
                    <td>{{$math->value2}}</td>
                    <td>{{$math->value3}}</td>
                    <td>{{$math->result}}</td>
                    <td><button class="trigger btn btn-danger text-light"> Delete </button></td>
                    <!--Delete Medal-->
                    <div class="modal" id="ajax-crud-modal">
                        <div class="modal-content"><span class="btn-close">&times;</span>
                            <form method="get" action="{{url('math')}}/delete/{{$math->id}}">
                                <p></p>
                                <h3 class="text-danger text-center">Delete</h3>
                                <p></p>
                                <div class="form-group row">
                                    <div class="offset-sm-4 col-sm-9">
                                        <button type="submit" class="btn btn-danger text-light">Confirm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </tr>
            @endforeach
            {{$res->links()}}
        @else
            <p> No result <p>
        @endif
        
        <script>
            const triggers = document.getElementsByClassName('trigger');
            const triggerArray = Array.from(triggers).entries();
            const modals = document.getElementsByClassName('modal');
            const closeButtons = document.getElementsByClassName('btn-close');
    
            for (let [index, trigger] of triggerArray) {
            let triggerIndex = index;
            function toggleModal() {
                modals[triggerIndex].classList.toggle('show-modal');
            }
            trigger.addEventListener("click", toggleModal);
            closeButtons[triggerIndex].addEventListener("click", toggleModal);
            }
        </script>

    </table>

@endsection
