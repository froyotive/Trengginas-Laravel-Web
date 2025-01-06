<x-filament-widgets::widget>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bold text-primary mb-0">{{ $this->getTotalSpkByFaktur() }}</h3>
                                <p class="text-muted mb-0">Total SPK Berdasarkan Faktur</p>
                            </div>
                            <div class="p-3 bg-primary bg-opacity-10 rounded">
                                <i class="fas fa-file-invoice fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>