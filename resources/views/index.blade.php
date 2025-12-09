@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="mb-0">🚀 Misi Hari Ini</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="input-group mb-4">
                            <input type="text" id="judulTask" class="form-control form-control-lg"
                                placeholder="Apa rencana hebatmu?" />
                            <button class="btn btn-primary" onclick="tambahTask()">
                                Simpan
                            </button>
                        </div>

                        <div id="loading" class="text-center text-muted py-3">
                            Sedang memuat data...
                        </div>
                        <div id="pesanError" class="alert alert-danger" style="display: none"></div>

                        <ul id="daftarList" class="list-unstyled"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
