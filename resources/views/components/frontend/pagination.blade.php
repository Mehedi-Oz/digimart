<style>
    .page-item {
        margin-right: 10px;
    }

    .page-item.active .page-link {
        background: #0655ff !important;
    }

    div .small.text-muted {
        display: none;
    }
</style>

<nav aria-label="Page navigation example">
    <ul class="pagination common-pagination">
        {{ $paginator->withQueryString()->links() }}
    </ul>
</nav>
