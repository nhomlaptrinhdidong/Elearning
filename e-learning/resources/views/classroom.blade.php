@extends('.layouts.admin')
@section('tab')
<div  >  
    <div class="custom-tab">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tab4" role="tab" aria-selected="true">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab5" role="tab" aria-selected="false">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab6" role="tab" aria-selected="false">Settings</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab4" role="tabpanel">
                <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                It has survived not only five centuries,but alsowhen an unknown printer took a galley of type 
                and scrambled it to make a type specimen book. It has survived not only five centuries, but 
                alsowhen an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                It has survived not only five centuries, but also</p>
            </div>
            <div class="tab-pane fade" id="tab5" role="tabpanel">
                <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                It has survived not only five centuries,but alsowhen an unknown printer took a galley of type 
                and scrambled it to make a type specimen book. It has survived not only five centuries, but 
                alsowhen an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                It has survived not only five centuries, but also</p>
            </div>
            <div class="tab-pane fade" id="tab6" role="tabpanel">
                <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                It has survived not only five centuries,but alsowhen an unknown printer took a galley of type 
                and scrambled it to make a type specimen book. It has survived not only five centuries, but 
                alsowhen an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                It has survived not only five centuries, but also</p>
            </div>
        </div>
    </div>
</div>
    @yield('name')
 @endsection