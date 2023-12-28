from django.db.models import Q
from django.http import JsonResponse

'''

This is the file that can create for data tables backend operations like 

SORT
SEARCH
PAGINATION

'''


def generate_datatables_json_response(request, queryset, columns, search_columns, extra_filters=None):
    draw = int(request.GET.get('draw', 1))
    start = int(request.GET.get('start', 0))
    length = int(request.GET.get('length', 10))
    search_value = request.GET.get('search[value]', '')

    # Construct the base Q object for filtering
    base_filter = Q()
    for column in search_columns:
        base_filter |= Q(**{f'{column}__icontains': search_value})

    # Apply any extra filters
    if extra_filters:
        base_filter &= extra_filters

    # Apply the base filter to the queryset
    queryset = queryset.filter(base_filter)

    total_records = queryset.count()
    queryset = queryset[start:start + length]

    data = []
    for item in queryset:
        row_data = {'id': item.id}
        for column in columns:
            row_data[column] = getattr(item, column)
        data.append(row_data)

    response = {
        'draw': draw,
        'recordsTotal': total_records,
        'recordsFiltered': total_records,
        'data': data,
    }

    return JsonResponse(response)
