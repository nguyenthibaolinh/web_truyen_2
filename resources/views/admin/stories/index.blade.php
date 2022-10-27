@extends('layout.master')
@section('main')
    @push('css')
        <style>
            [class^="pe-"] {
                font-size: 30px;
            }
        </style>
    @endpush
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="content">
                        <form action="" method="get" id="form-filter" class="form-inline">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-target="#collapseOne" href="#" data-toggle="collapse-hover">
                                                    <div class="form-group">
                                                        <label for="">Thể loại</label>
                                                    </div>
                                                    <b class="caret"></b>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse collapse-hover"
                                            style="height: 0px;">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="checkbox">
                                                            <input class="categories_reset" id="categories_reset"
                                                                name="" type="checkbox" value="">
                                                            <label for="categories_reset" style="padding-left: 24px">
                                                                Bỏ chọn
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @foreach ($categories as $category)
                                                        <div class="col-sm-3">
                                                            <div class="checkbox">
                                                                <input class="filter-input"
                                                                    @if (isset($categoriesFilter) && in_array($category->id, $categoriesFilter)) checked @endif
                                                                    id="categories{{ $category->id }}" name="categories[]"
                                                                    type="checkbox" value="{{ $category->id }}">
                                                                <label for="categories{{ $category->id }}"
                                                                    style="padding-left: 24px">
                                                                    {{ $category->name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 col-md-offset-3">
                                    <a href="{{ route("admin.$table.index") }}" class="btn btn-default btn-fill"
                                        style="margin: 24px">
                                        <i class="fa fa-spin fa-refresh"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="control-label">Tình trạng</label>
                                <select name="status" id="status" class="form-control filter-input"
                                    style="margin-left: 6px">
                                    <option value="">All</option>
                                    @foreach ($status as $value => $name)
                                        <option value="{{ $value }}"
                                            @if ($statusFilter === (string) $value) selected @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="margin-left: 16px">
                                <label for="level" class="control-label">Phân loại</label>
                                <select name="level" id="level" class="form-control filter-input"
                                    style="margin-left: 6px">
                                    <option value="">All</option>
                                    @foreach ($level as $value => $name)
                                        <option value="{{ $value }}"
                                            @if ($levelFilter === (string) $value) selected @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="margin-left: 16px">
                                <label for="pin" class="control-label">Trạng thái</label>
                                <select name="pin" id="pin" class="form-control filter-input"
                                        style="margin-left: 6px">
                                    <option value="">All</option>
                                    @foreach ($pin as $value => $name)
                                        <option value="{{ $value }}"
                                                @if ($pinFilter === (string) $value) selected @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="margin-left: 16px">
                                <label for="author" class="control-label">Tác giả</label>
                                <select name="author" id="author" class="form-control filter-input"
                                    style="margin-left: 6px">
                                    <option value="">All</option>
                                    @foreach ($author as $row)
                                        <option value="{{ $row->id }}"
                                            @if ($authorFilter === (string) $row->id) selected @endif>{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="margin-left: 16px">
                                <label for="author_2" class="control-label">Tác giả 2</label>
                                <select name="author_2" id="author_2" class="form-control filter-input"
                                    style="margin-left: 6px">
                                    <option value="">All</option>
                                    @foreach ($author_2 as $row)
                                        <option value="{{ $row->id }}"
                                            @if ($author_2Filter === (string) $row->id) selected @endif>{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="margin-left: 16px">
                                <label for="users" class="control-label">Người đăng</label>
                                <select name="users" id="users" class="form-control filter-input"
                                    style="margin-left: 6px">
                                    <option value="">All</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            @if ($usersFilter === (string) $user->id) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="bootstrap-table">
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên truyện</th>
                                        <th>Thể loại</th>
                                        <th>Số chương</th>
                                        <th>Tình trạng</th>
                                        <th>Phân loại</th>
                                        <th>Tác giả</th>
                                        <th>Tác giả 2</th>
                                        <th>Người đăng</th>
                                        <th>Ảnh đại diện</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $story)
                                        <tr>
                                            <td>{{ $story->id }}</td>
                                            <td>{{ $story->name }}</td>
                                            <td>{{ implode(', ', $story->categories->pluck('name')->toArray()) }}</td>
                                            <td>{{ $story->chapter_count }}</td>
                                            <td>{{ \App\Enums\StoryStatusEnum::getNameByValue($story->status) }}</td>
                                            <td>{{ \App\Enums\StoryLevelEnum::getNameByValue($story->level) }}</td>
                                            <td>{{ $story->author->name }}</td>
                                            <td>{{ optional($story->author_2)->name }}</td>
                                            <td>{{ optional($story->user)->name }}</td>
                                            <td><img src="{{ $story->image }}"></td>
                                            <td>{{ \App\Enums\StoryPinEnum::getNameByValue($story->pin) }}</td>
                                            @auth
                                                @if (auth()->user()->level_id === 2 || auth()->user()->level_id === 3)
                                                    <td class="td-actions text-right">
                                                        <div style="display: flex;">
                                                            <a rel="tooltip" data-original-title="Xem"
                                                                href="{{ route("admin.$table.edit", $story->id) }}"
                                                                class="btn btn-simple btn-info btn-icon table-action">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            @if ($story->pin === 1)
                                                                <form
                                                                    action="{{ route("admin.$table.approve", $story->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <button rel="tooltip" data-original-title="duyệt"
                                                                        class="btn btn-simple btn-success btn-icon
                                                                    table-action">
                                                                        <i class="fa fa-check"></i>
                                                                    </button>
                                                                </form>
                                                            @endif

                                                            <form
                                                                action='{{ route("admin.$table.pinned", $story->id) }}'
                                                                method="post" id="pinnedForm">
                                                                @csrf
                                                            <div class="checkbox" style="margin-top: 8px;">
                                                                <input type="checkbox" id="pin-{{ $story->id }}"
                                                                    {{ $story->pin === 3 ? 'checked' : '' }}
                                                                    class="pinnedInput"
                                                                >
                                                                <label data-original-title="ghim" rel="tooltip"
                                                                    for="pin-{{ $story->id }}"></label>
                                                            </div>
                                                            </form>

                                                            <form action="{{ route("admin.$table.destroy", $story->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button rel="tooltip" data-original-title="Xóa"
                                                                    class="btn btn-simple btn-danger btn-icon table-action">
                                                                    <i class="fa fa-remove"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                @endif
                                            @endauth
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="fixed-table-pagination">
                            <div class="pull-right pagination">
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            const formFilter = document.querySelector('#form-filter');
            const inputFilter = document.querySelectorAll('.filter-input');
            inputFilter.forEach((input) => {
                input.onchange = () => {
                    formFilter.submit();
                }
            })
            const categoriesReset = document.getElementById('categories_reset');
            categoriesReset.oninput = () => {
                inputFilter.forEach((input) => {
                    input.checked = false;
                })
                formFilter.submit();
            }

            const pinnedForm = document.getElementById('pinnedForm');
            const pinnedInput = document.querySelectorAll('.pinnedInput')

            pinnedInput.forEach((input) => {
                input.onchange = () => {
                    pinnedForm.submit();
                }
            })
        </script>
    @endpush
@endsection