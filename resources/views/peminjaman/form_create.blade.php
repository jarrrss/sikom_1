
@extends('_template_back.layout')

@section('content')
    	<!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Hi, welcome back!</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a   href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Basic Tables</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        			<!-- row -->
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								@include('_component.pesan')
								<div class="main-content-label mg-b-5">
									Form Input Data Buku
								</div>
								<p class="mg-b-20">Harap untuk mengisi semua input</p>

								<div class="pd-30 pd-sm-40 bg-gray-100">
                                    <form action="{{ route('peminjaman.store') }}" method="post">
                                        @csrf
									<div class="row row-xs align-items-center mg-b-20">
										<div class="col-md-4">
											<label class="form-label mg-b-0">Judul Buku</label>
										</div>
										<div class="col-md-8 mg-t-5 mg-md-t-0">
											<select name="buku_id" id="">
                                                <option value="" selected disabled>Pilih Buku</option>
                                                @foreach ($buku as $dt)
                                                <option value="{{ $dt->id }}">{{ $dt->judul }}</option>
                                                @endforeach
                                            </select>
										</div>
									</div>
									<div class="row row-xs align-items-center mg-b-20">
										<div class="col-md-4">
											<label class="form-label mg-b-0">Tanggal Peminjaman</label>
										</div>
										<div class="col-md-8 mg-t-5 mg-md-t-0">
											<input class="form-control" placeholder="Enter your tanggal peminjaman" name="tanggal_peminjaman" type="date">
										</div>
									</div>
									<div class="row row-xs align-items-center mg-b-20">
										<div class="col-md-4">
											<label class="form-label mg-b-0">Tanggal Pengembalian</label>
										</div>
										<div class="col-md-8 mg-t-5 mg-md-t-0">
											<input class="form-control" placeholder="Enter your tanggal pengembalian" name="tanggal_pengembalian" type="date">
										</div>
									</div>
									<div class="row row-xs align-items-center mg-b-20">
										<div class="col-md-4">
											<label class="form-label mg-b-0">Status Peminjaman</label>
										</div>
										<div class="col-md-8 mg-t-5 mg-md-t-0">
											<input class="form-control" placeholder="Enter your Tahun Terbit" name="status_peminjaman" type="text">
										</div>
									</div>
									<button class="btn btn-primary pd-x-30 mg-e-5 mg-t-5" type="submit">Simpan</button>
									<a href="{{route('buku.index')}}" class="btn btn-dark pd-x-30 mg-t-5"> << BACK</a>
                                </form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /row -->

@endsection
