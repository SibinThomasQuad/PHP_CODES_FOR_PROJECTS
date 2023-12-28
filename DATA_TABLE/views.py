'''
This is the code that can use as view

'''



def test_data(request):
    columns = ['tank_name', 'date', 'status', 'checked_by', 'notes', 'project_no', 'hull_number']
    search_columns = ['id', 'tank_name', 'date', 'status', 'checked_by', 'notes', 'project_no', 'hull_number']
    queryset = TankTest.objects.all()
    extra_filters = Q(project_no=request.GET.get('project_no'))
    return data_tables.generate_datatables_json_response(request, queryset, columns, search_columns, extra_filters)
