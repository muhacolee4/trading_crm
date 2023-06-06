<div class="my-3">
    @isset($links->current_page)
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-start pagination-sm">
                @foreach ($links->links as $link)
                    @php
                        parse_str(parse_url($link->url)['query'], $params);
                        $page = $params['page'];
                    @endphp

                    @if ($link->url == null)
                        <li class="page-item disabled">
                            <a class="page-link">{{ html_entity_decode($link->label) }}</a>
                        </li>
                    @else
                        <li class="page-item {{ $link->active ? 'active' : '' }}">
                            <a class="page-link"
                                href="{{ route('signals', ['page' => $page]) }}">{{ html_entity_decode($link->label) }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
    @endisset
</div>
