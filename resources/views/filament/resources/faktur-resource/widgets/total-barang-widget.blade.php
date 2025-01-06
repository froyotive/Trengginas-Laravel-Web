<x-filament-widgets::widget>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bold text-info mb-0">{{ $this->getStats()[0]->value }}</h3>
                                <p class="text-muted mb-0">Total Barang</p>
                            </div>
                            <div class="p-3 bg-info bg-opacity-10 rounded">
                                <i class="fas fa-cube fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
