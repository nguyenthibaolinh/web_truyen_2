@extends('layout.master')
@section('main')
    @push('css')
        <link rel="stylesheet" href="{{ asset('user_asset/css/story_view.css') }}">
    @endpush
    <div class="row">
        <div class="col-md-7">
            {{ Breadcrumbs::render("admin.$table.view", $story) }}
        </div>
        <div class="col-md-5">
            <div class="stories_box">
                <div class="card">
                    <form action="{{ route("admin.$table.find") }}" method="get" id="stories_box_form" class="form-inline">
                        <div class="content">
                            <div class="form-group">
                                <label for="story_id" class="control-label">Chọn truyện</label>
                                <select name="story_id" id="story_id" class="form-control">
                                    @foreach ($stories as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id === $story->id) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="story_info">
        <div class="story_title">
            <h3>Thông tin truyện</h3>
        </div>
        <div class="story_name">
            <h2>{{ $story->name }}</h2>
        </div>
        <div class="story_box">
            <div class="story_box_left">
                <div class="story_box_left_top">
                    <a href="{{ $story->image_url }}" target="_blank">
                        <div class="story_box_left_top_image">
                            <img src="{{ $story->image_url }}" alt="{{ $story->name }}">
                            <div class="book-shadow"></div>
                        </div>
                    </a>
                </div>
                <div class="story_box_left_bottom">
                    <div class="story_box_left_bottom_item">
                        <strong>Phân loại:</strong>
                        <span>{{ $story->level_name }}</span>
                    </div>
                    <div class="story_box_left_bottom_item">
                        <strong>Tác giả:</strong>
                        <span>{{ $story->author->name }}</span>
                    </div>
                    @isset($story->author_2)
                        <div class="story_box_left_bottom_item">
                            <strong>Người sửa:</strong>
                            <span>{{ $story->author_2->name }}</span>
                        </div>
                    @endisset
                    <div class="story_box_left_bottom_item">
                        <strong>Thể loại:</strong>
                        <span>{!! $story->categories_link !!}</span>
                    </div>
                    <div class="story_box_left_bottom_item">
                        <strong>Tình trạng:</strong>
                        <span>{{ $story->status_name }}</span>
                    </div>
                    <div class="story_box_left_bottom_item">
                        <strong>Trạng thái:</strong>
                        <span>{{ $story->pin_name }}</span>
                    </div>
                    <div class="story_box_left_bottom_item">
                        <strong>Số chương:</strong>
                        <span>{{ $story->chapter_count }}</span>
                    </div>
                </div>
            </div>
            <div class="story_box_right">
                <div class="story_box_right_rate">

                </div>
                <div class="story_box_right_desc">
                    {!! $story->descriptions !!}
                </div>
            </div>
        </div>
    </div>
    <div class="chapter_box">
        <div class="story_title">
            <h3>Danh sách chương</h3>
        </div>
        <div class="chapter_list">
            @foreach ($chapters as $chapter)
                <div class="chapter_box_item" style="display: flex; justify-content: space-between">
                    <a style="display: flex; align-items: center;"
                        href="{{ route("admin.$table.chapters.index", ['id' => $story->id, 'number' => $chapter->number]) }}">
                        <span class="chapter_box_item_text">
                            <span>Chương </span> {{ $chapter->number }}: {{ $chapter->name }}
                        </span>
                    </a>
                </div>
            @endforeach
        </div>
        <div style="display: flex; justify-content: center;">
            {{ $chapters->links() }}
        </div>
    </div>
    @push('js')
        <script>
            const stories_box_form = document.querySelector('#stories_box_form');
            const story_id = document.getElementById('story_id');
            story_id.onchange = () => {
                stories_box_form.submit();
            }
        </script>
    @endpush
@endsection