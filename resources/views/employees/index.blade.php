@extends('layouts.index')

@section('content')
    @include('partials.breadcrumbs')
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                @include('adminlte-templates::common.alerts')
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        @if ($canwrite)
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <a href="{{ route('employees.create') }} ">
                                    <button type="button" class="btn btn-primary btn-sm"><i class="far fa-plus-square"></i>
                                        Tambah</button>
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        @include('employees.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script nonce="{{ csp_nonce() }}">
        document.addEventListener("DOMContentLoaded", function(event) {
                let employees = $('#employees-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ordering: true,
                searchPanes: {
                    viewTotal: false,
                    columns: [0]
                },
                ajax: {
                    url: `{{ route('employees.index') }}`,
                    method: 'get',
                    data: function(row) {
                        return {
                            "page[size]": row.length,
                            "page[number]": (row.start / row.length) + 1,
                            "filter[search]": row.search.value,
                            "sort": (row.order[0]?.dir === "asc" ? "" : "-") + row.columns[row.order[0]?.column]
                                ?.name,
                        };
                    },
                    dataSrc: function(json) {
                        json.recordsTotal = json.meta.pagination.total
                        json.recordsFiltered = json.meta.pagination.total

                        return json.data
                    },
                },
                columnDefs: [{
                        targets: '_all',
                        className: 'text-nowrap',
                    },
                ],
                columns: [{
                            data: null,
                        },
                        {
                            data: "attributes.name",
                            name: "name"
                        },
                        {
                            data: "attributes.identity_number",
                            name: "identity_number"
                        },
                        {
                            data: "attributes.email",
                            name: "email"
                        },
                        {
                            data: "attributes.description",
                            name: "description"
                        },
                        {
                            data: "attributes.phone",
                            name: "phone"
                        },
                        {
                            data: "attributes.foto",
                            name: "foto"
                        },
                        {
                            data: "attributes.position_id",
                            name: "position_id"
                        },
                        {
                            data: "attributes.department_id",
                            name: "department_id"
                        },

                        {
                            data: function (data) {
                                let canEdit = `{{ $canedit }}`
                                let canDelete = `{{ $candelete }}`
                                let buttonEdit = canEdit ? `<a href="{{ route('employees.index') }}/${data.id}/edit">
                                        <button type="button" class="btn btn-warning btn-sm edit" title="Ubah">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>` : ``;
                                let buttonDelete = canDelete ? `<button type="button" class="btn btn-danger btn-sm hapus" data-id="${data.id}" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>` : ``;
                                return `${buttonEdit} ${buttonDelete}`;
                            },
                        },
                ],
                order: [
                    [0, 'asc']
                ]
            })

            employees.on('draw.dt', function() {
                var PageInfo = $('#employees-table').DataTable().page.info();
                employees.column(0, {
                    page: 'current'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                });
            });

                $(document).on('click', 'button.hapus', function() {
                    var id = $(this).data('id')
                    var that = $(this);
                    Swal.fire({
                        title: 'Hapus',
                        text: "Apakah anda yakin menghapus data ini?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Hapus'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Menyimpan',
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                            })
                            $.ajax({
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                dataType: "json",
                                url: `{{ route('employees.index') }}/${id}`,
                                data: {
                                    id: id
                                },
                                success: function(response) {

                                    if (response.success == true) {
                                        Swal.fire(
                                            'Hapus!',
                                            'Data berhasil dihapus',
                                            'success'
                                        )
                                        that.parent().parent().remove();
                                    } else {
                                        Swal.fire(
                                            'Error!',
                                            response.message,
                                            'error'
                                        )
                                    }
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    Swal.fire(
                                        'Error!',
                                        thrownError,
                                        'error'
                                    )

                                }
                            });
                        }
                    })
                });
            });

    </script>
@endsection
