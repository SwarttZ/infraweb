@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/cropped/ijaboCropTool.min.css') }}">

@endpush
<!-- About Me Box -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Usuários Online</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {{ \Carbon\Carbon::setLocale('pt_BR') }}
        @foreach($status as $user)
        @if(Cache::has('is_online' . $user->id))
        <span class="text-success">{{ $user->name }}: Online </span>
        <hr>
        @else
        <span class="text-secondary">{{ $user->name }}: Offline {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</span>
        @endif
        @endforeach
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.col -->
<div class="col-md-9">
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab"></a></li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                        <div class="user-block">

                            <!-- END timeline item -->
                            <div>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    @if(Auth()->user()->level > 1)
                    <div class="tab-pane" id="settings">
                        <div class="container mt-5">
                            <h3>Escolher foto do perfil</h3>
                            <div class="previewImage" width="200" height="200"></div>
                            <input type="file" name="file" id="file">
                        </div>
                    </div>
                    @endif
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
@push('scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://unpkg.com/tagin@2.0.2/dist/tagin.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('backend/plugins/cropped/ijaboCropTool.min.js') }}"></script>
<script>
    $('#file').ijaboCropTool({
        preview: '.image-previewer'
        , setRatio: 1
        , allowedExtensions: ['jpg', 'jpeg', 'png']
        , buttonsText: ['Cortar', 'Cancelar']
        , preview: '.previewImage'
        , buttonsColor: ['#30bf7d', '#ee5155', -15]
        , processUrl: '{{ route("admin.users.crop") }}'
        , withCSRF: ['_token', '{{ csrf_token() }}']
        , onSuccess: function(message, element, status) {
            alert(message);
        }
        , onError: function(message, element, status) {
            alert(message);
        }
    });

</script>
@endpush
