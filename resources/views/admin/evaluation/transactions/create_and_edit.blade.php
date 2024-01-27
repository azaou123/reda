@extends('admin.layouts.app')
@section('tab_name', __('admin.EvaluationTransactions'))

@section('content')
<style>
    .select2-container--default .select2-selection--single {
        height: 53px !important;
    }

</style>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">@lang('admin.EvaluationTransactions') /
                    @if ($item->id)
                    @lang('admin.Edit') #{{ $item->id }}
                    @else
                    Add
                    @endif
                </h4>
                <hr>
                @if ($item->id)
                <form id="target" class="needs-validation" action="{{ route('admin.evaluation-transactions.update', $item->id) }}" method="POST" enctype='multipart/form-data' novalidate>
                    <input type="hidden" name="_method" value="PUT">
                    @else
                    <form class="needs-validation" action="{{ route('admin.evaluation-transactions.store') }}" method="POST" enctype='multipart/form-data' novalidate>
                        @endif
                        @csrf

                        <input type="hidden" name="status">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row ">
                                    <label for="instrument_number-field" class="col-sm-3 col-form-label">
                                        @lang('admin.instrument_number')
                                        <input class=" " type="button" id="chick" value="معاينة">
                                    </label>

                                    <div class="col-sm-9 ">
                                        <input required id="instrument_number-field" type="text" class="form-control @if ($errors->has('instrument_number')) is-invalid @endif" name="instrument_number" value="{{ $item->instrument_number ?? old('instrument_number') }}" />
                                        <div class="" id="invalid"> </div>

                                        @if ($errors->has('instrument_number'))
                                        <span class="invalid-feedback">{{ $errors->first('instrument_number') }}</span>
                                        @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row ">
                                    <label for="transaction_number-field" class="col-sm-3 col-form-label">
                                        @lang('admin.transaction_number')
                                    </label>
                                    <div class="col-sm-9 ">
                                        <input required id="transaction_number-field" type="text" class="form-control @if ($errors->has('transaction_number')) is-invalid @endif" name="transaction_number" value="{{ $item->transaction_number ?? old('transaction_number') }}" />
                                        @if ($errors->has('transaction_number'))
                                        <span class="invalid-feedback">{{ $errors->first('transaction_number') }}</span>
                                        @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row ">
                                    <label for="owner_name-field" class="col-sm-3 col-form-label"> @lang('admin.owner_name')
                                    </label>
                                    <div class="col-sm-9 ">
                                        <input required id="owner_name-field" type="text" class="form-control @if ($errors->has('owner_name')) is-invalid @endif" name="owner_name" value="{{ $item->owner_name ?? old('owner_name') }}" />
                                        @if ($errors->has('owner_name'))
                                        <span class="invalid-feedback">{{ $errors->first('owner_name') }}</span>
                                        @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            @if($item->region)
                            <div class="col-md-6">
                                <div class="form-group row ">
                                    <label for="region-field" class="col-sm-3 col-form-label"> @lang('admin.region') </label>
                                    <div class="col-sm-9 ">
                                        <input id="region-field" type="text" class="form-control @if ($errors->has('region')) is-invalid @endif" name="region" value="{{ $item->region ?? old('region') }}" />
                                        @if ($errors->has('region'))
                                        <span class="invalid-feedback">{{ $errors->first('region') }}</span>
                                        @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            @endif

                            {{-- المدينة (جديد) --}}
                            <div class="col-md-6">
                                <div class="form-group row ">
                                    <label for="new_city_id" class="col-sm-3 col-form-label"> @lang('admin.region') </label>
                                    <div class="col-sm-9 ">
                                        <select required id="new_city_id" name="new_city_id" class="form-control js-select2 @if ($errors->has('new_city_id')) is-invalid @endif" value="{{ $item->new_city_id ?? old('new_city_id') }}">
                                            <option value="">اختر</option>

                                            @foreach ($cities as $city)
                                            <option {{ old('new_city_id', $item->new_city_id) == $city->id ? 'selected' : '' }} value="{{ $city->id }}">
                                                {{ $city->name_ar }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('new_city_id'))
                                        <span class="invalid-feedback">{{ $errors->first('new_city_id') }}</span>
                                        @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- رقم المخطط --}}
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="plan_no" class="col-sm-3 col-form-label">
                                        @lang('admin.plan_no')
                                    </label>

                                    <div class="col-sm-9 ">
                                        <input required id="plan_no" type="text" class="form-control @if ($errors->has('plan_no')) is-invalid @endif" name="plan_no" value="{{ $item->plan_no ?? old('plan_no') }}" />
                                        <div class="" id="invalid"> </div>

                                        @if ($errors->has('plan_no'))
                                        <span class="invalid-feedback">{{ $errors->first('plan_no') }}</span>
                                        @else
                                        <div class="invalid-feedback">إجبارى الأختيار</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- رقم القطعة --}}
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="plot_no" class="col-sm-3 col-form-label">
                                        @lang('admin.plot_no')
                                        <input type="button" id="check_new_region" value="معاينة">
                                    </label>

                                    <div class="col-sm-9">
                                        <input required id="plot_no" type="text" class="form-control @if ($errors->has('plot_no')) is-invalid @endif" name="plot_no" value="{{ $item->plot_no ?? old('plot_no') }}" />
                                        <div class="" id="new_region_check_result"> </div>

                                        <span class="invalid-feedback">{{ $errors->first('new_region_check_result') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row ">
                                    <label for="type_id-field" class="col-sm-3 col-form-label">
                                        @lang('admin.type_id')</label>
                                    <div class="col-sm-9 @if ($errors->has('type_id')) is-invalid @endif">
                                        <select required class="form-control" name="type_id">
                                            <option> </option>
                                            @foreach ($result['types'] as $company)
                                            <option {{ old('type_id', $item->type_id) == $company->id ? 'selected' : '' }} value="{{ $company->id }}">
                                                {{ $company->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('type_id'))
                                        <span class="invalid-feedback">{{ $errors->first('type_id') }}</span>
                                        @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if($item->city_id)
                            <div class="col-md-6">
                                <div class="form-group row ">
                                    <label for="city_id-field" class="col-sm-3 col-form-label">
                                        @lang('admin.city_id')</label>
                                    <div class="col-sm-9 @if ($errors->has('city_id')) is-invalid @endif">
                                        <select required class="form-control" name="city_id">
                                            <option></option>

                                            @foreach ($result['cities'] as $city)
                                            <option {{ old('city_id', $item->city_id) == $city->id ? 'selected' : '' }} value="{{ $city->id }}">
                                                {{ $city->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('city_id'))
                                        <span class="invalid-feedback">{{ $errors->first('city_id') }}</span>
                                        @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="col-md-6">
                                <div class="form-group row ">
                                    <label for="evaluation_company_id-field" class="col-sm-3 col-form-label">
                                        @lang('admin.evaluation_company_id')</label>
                                    <div class="col-sm-9 @if ($errors->has('evaluation_company_id')) is-invalid @endif">
                                        @isset($result['company'])
                                        @if($result['company']!=null)
                                        <input type="hidden" name="company" value="{{$result['company']->id}}">
                                        @endif
                                        @endisset
                                        <select required class="form-control js-select2" name="evaluation_company_id">
                                            <option> </option>
                                            @if($result['company']!=null)

                                            <option selected value="{{ $result['company']->id }}">
                                                {{ $result['company']->title }}
                                            </option>


                                            @else
                                            @foreach ($result['companies'] as $company)
                                            <option {{ old('evaluation_company_id', $item->evaluation_company_id) == $company->id ? 'selected' : '' }} value="{{ $company->id }}">
                                                {{ $company->title }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('evaluation_company_id'))
                                        <span class="invalid-feedback">{{ $errors->first('evaluation_company_id') }}</span>
                                        <span class="invalid-feedback">{{ $errors->first('city_id') }}</span>
                                        @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row ">
                                    <label for="evaluation_employee_id-field" class="col-sm-3 col-form-label">
                                        @lang('admin.evaluation_employee_id')</label>
                                    <div class="col-sm-9 @if ($errors->has('evaluation_employee_id')) is-invalid @endif">
                                        <select class="form-control js-select2" name="evaluation_employee_id">
                                            <option value="">@lang('admin.No_employee')</option>
                                            @foreach ($result['employees'] as $employee)
                                            <option {{ old('evaluation_employee_id', $item->evaluation_employee_id) == $employee->id ? 'selected' : '' }} value="{{ $employee->id }}">
                                                {{ $employee->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('evaluation_employee_id'))
                                        <span class="invalid-feedback">{{ $errors->first('evaluation_employee_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row ">
                                    <label for="date-field" class="col-sm-3 col-form-label"> @lang('admin.date')
                                    </label>
                                    <div class="col-sm-9 ">
                                        <input required id="date-field" type="date" class="form-control @if ($errors->has('date')) is-invalid @endif" name="date" value="{{ $item->date ?? old('date') }}" />
                                        @if ($errors->has('date'))
                                        <span class="invalid-feedback">{{ $errors->first('date') }}</span>
                                        @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <fieldset class="form-group p-4" style="border: 1px solid #CCC">
                                <legend class="col-form-label col-sm-2 py-0 text-center" style="float: unset">معلومات المعاينة</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row ">
                                            <label for="previewer-field" class="col-sm-3 col-form-label">
                                                @lang('admin.evaluation-transactions.forms.previewer')
                                            </label>
                                            <div class="col-sm-9 @if ($errors->has('previewer_id')) is-invalid @endif">
                                                <select class="form-control js-select2" name="previewer_id">
                                                    <option value="">@lang('admin.No_employee')</option>

                                                    @foreach ($result['employees'] as $employee)
                                                    <option {{ old('previewer_id', $item->previewer_id) == $employee->id ? 'selected' : '' }} value="{{ $employee->id }}">
                                                        {{ $employee->title }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('previewer_id'))
                                                <span class="invalid-feedback">{{ $errors->first('previewer_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row ">
                                            <label for="preview_date" class="col-sm-3 col-form-label">
                                                @lang('admin.evaluation-transactions.forms.preview_date')
                                            </label>
                                            <div class="col-sm-9">
                                                <input id="preview_date" type="date" class="form-control @if ($errors->has('preview_date')) is-invalid @endif" name="preview_date" value="{{ $item->preview_date ?? old('preview_date') }}" />
                                                @if ($errors->has('preview_date'))
                                                <span class="invalid-feedback">{{ $errors->first('preview_date') }}</span>
                                                @else
                                                <div class="invalid-feedback">إجبارى الأختيار</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row ">
                                            <label for="preview_time" class="col-sm-3 col-form-label">
                                                @lang('admin.evaluation-transactions.forms.preview_time')
                                            </label>
                                            <div class="col-sm-9">
                                                <input id="preview_time" type="time" class="form-control @if ($errors->has('preview_time')) is-invalid @endif" name="preview_time" value="{{ $item->preview_time ?? old('preview_time') }}" style="direction: ltr" />
                                                @if ($errors->has('preview_time'))
                                                <span class="invalid-feedback">{{ $errors->first('preview_time') }}</span>
                                                @else
                                                <div class="invalid-feedback">إجبارى الأختيار</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="form-group p-4" style="border: 1px solid #CCC">
                                <legend class="col-form-label col-sm-2 py-0 text-center" style="float: unset">معلومات المراجعة</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row ">
                                            <label for="review-field" class="col-sm-3 col-form-label">
                                                @lang('admin.evaluation-transactions.forms.reviewer')
                                            </label>

                                            <div class="col-sm-9 @if ($errors->has('review_id')) is-invalid @endif">
                                                <select class="form-control js-select2" name="review_id">
                                                    <option value="">@lang('admin.No_employee')</option>

                                                    @foreach ($result['employees'] as $employee)
                                                    <option {{ old('review_id', $item->review_id) == $employee->id ? 'selected' : '' }} value="{{ $employee->id }}">
                                                        {{ $employee->title }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('review_id'))
                                                <span class="invalid-feedback">{{ $errors->first('review_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row ">
                                            <label for="review_date" class="col-sm-3 col-form-label">
                                                @lang('admin.evaluation-transactions.forms.review_date')
                                            </label>
                                            <div class="col-sm-9">
                                                <input id="review_date" type="date" class="form-control @if ($errors->has('review_date')) is-invalid @endif" name="review_date" value="{{ $item->review_date ?? old('review_date') }}" />
                                                @if ($errors->has('review_date'))
                                                <span class="invalid-feedback">{{ $errors->first('review_date') }}</span>
                                                @else
                                                <div class="invalid-feedback">إجبارى الأختيار</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row ">
                                            <label for="review_time" class="col-sm-3 col-form-label">
                                                @lang('admin.evaluation-transactions.forms.review_time')
                                            </label>
                                            <div class="col-sm-9">
                                                <input id="review_time" type="time" class="form-control @if ($errors->has('review_time')) is-invalid @endif" name="review_time" value="{{ $item->review_time ?? old('review_time') }}" style="direction: ltr" />
                                                @if ($errors->has('review_time'))
                                                <span class="invalid-feedback">{{ $errors->first('review_time') }}</span>
                                                @else
                                                <div class="invalid-feedback">إجبارى الأختيار</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="form-group p-4" style="border: 1px solid #CCC">
                                <legend class="col-form-label col-sm-2 py-0 text-center" style="float: unset">معلومات الإدخال</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row ">
                                            <label for="income-field" class="col-sm-3 col-form-label">
                                                @lang('admin.evaluation-transactions.forms.income')
                                            </label>
                                            <div class="col-sm-9 @if ($errors->has('income_id')) is-invalid @endif">
                                                <select class="form-control js-select2" name="income_id">
                                                    <option value="">@lang('admin.No_employee')</option>

                                                    @foreach ($result['employees'] as $employee)
                                                    <option {{ old('income_id', $item->income_id) == $employee->id ? 'selected' : '' }} value="{{ $employee->id }}">
                                                        {{ $employee->title }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('income_id'))
                                                <span class="invalid-feedback">{{ $errors->first('income_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row ">
                                            <label for="income_date" class="col-sm-3 col-form-label">
                                                @lang('admin.evaluation-transactions.forms.income_date')
                                            </label>
                                            <div class="col-sm-9">
                                                <input id="income_date" type="date" class="form-control @if ($errors->has('income_date')) is-invalid @endif" name="income_date" value="{{ $item->income_date ?? old('income_date') }}" />
                                                @if ($errors->has('income_date'))
                                                <span class="invalid-feedback">{{ $errors->first('income_date') }}</span>
                                                @else
                                                <div class="invalid-feedback">إجبارى الأختيار</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row ">
                                            <label for="income_time" class="col-sm-3 col-form-label">
                                                @lang('admin.evaluation-transactions.forms.income_time')
                                            </label>
                                            <div class="col-sm-9">
                                                <input id="income_time" type="time" class="form-control @if ($errors->has('income_time')) is-invalid @endif" name="income_time" value="{{ $item->income_time ?? old('income_time') }}" style="direction: ltr" />
                                                @if ($errors->has('income_time'))
                                                <span class="invalid-feedback">{{ $errors->first('income_time') }}</span>
                                                @else
                                                <div class="invalid-feedback">إجبارى الأختيار</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>


                            <div class="col-md-12"></div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="notes-field">@lang('admin.Notes')</label>
                                    <div class="col-sm-9 @if ($errors->has('notes')) is-invalid @endif">

                                        <textarea class="form-control @if ($errors->has('notes')) is-invalid @endif" name="notes" rows="10">{{ old('notes', $item->notes) ?? '' }}</textarea>
                                        @if ($errors->has('notes'))
                                        <span class="invalid-feedback">{{ $errors->first('notes') }}</span>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <!--  -->
                            <div class="col-md-6">
                                <div class="form-group row ">
                                    <label for="company_fundoms-field" class="col-sm-3 col-form-label"> @lang('admin.company_fundoms') </label>
                                    <div class="col-sm-9 ">
                                        <input id="company_fundoms-field" type="number" class="form-control @if ($errors->has('company_fundoms')) is-invalid @endif" name="company_fundoms" value="{{ $item->company_fundoms ?? old('company_fundoms') }}" />
                                        @if ($errors->has('company_fundoms'))
                                        <span class="invalid-feedback">{{ $errors->first('company_fundoms') }}</span>
                                        @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row ">
                                    <label for="review_fundoms-field" class="col-sm-3 col-form-label"> @lang('admin.review_fundoms') </label>
                                    <div class="col-sm-9 ">
                                        <input id="review_fundoms-field" type="number" class="form-control @if ($errors->has('review_fundoms')) is-invalid @endif" name="review_fundoms" value="{{ $item->review_fundoms ?? old('review_fundoms') }}" />
                                        @if ($errors->has('review_fundoms'))
                                        <span class="invalid-feedback">{{ $errors->first('review_fundoms') }}</span>

                                        @endif

                                    </div>
                                </div>
                            </div>

                            <!--  -->

                            <div class="col-md-6">
                                <div class="form-group row ">
                                    <label for="phone-field" class="col-sm-3 col-form-label"> @lang('admin.phone') </label>
                                    <div class="col-sm-9 ">
                                        <input required id="phone-field" type="tel" class="form-control @if ($errors->has('phone')) is-invalid @endif" name="phone" value="{{ $item->phone ?? old('phone') }}" />
                                        @if ($errors->has('phone'))
                                        <span class="invalid-feedback">{{ $errors->first('phone') }}</span>
                                        <span class="invalid-feedback">{{ $errors->first('city_id') }}</span>
                                        @else
                                        <div class="invalid-feedback">إجبارى الأختيار </div>
                                        @endif


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row ">
                                    <label for="files-field" class="col-sm-3 col-form-label"> @lang('admin.files') </label>
                                    <div class="col-sm-9 ">
                                        <input multiple id="files-field" type="file" class="form-control @if ($errors->has('files')) is-invalid @endif" name="files[]" value="{{ $item->files ?? old('files') }}" />
                                        @if ($errors->has('files'))
                                        <span class="invalid-feedback">{{ $errors->first('files') }}</span>
                                        @else
                                        <span class="invalid-feedback">إجبارى الأختيار</span>


                                        @endif

                                    </div>
                                    @foreach($item->files as $file)
                                    <span>{{$file->path}}</span>
                                    <td style="display:block" class="text-left"> <a href="{{url('admin/evaluation-transactions/Delete/File/'.$file->id.'')}}" rel="noopener noreferrer"> حذف</a> </td>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-12">
                                <hr>
                                <button id="save" type="submit" name="action" value="save" class="btn btn-primary">@lang('admin.Save')</button>

                                <a class="btn btn-danger pull-right text-white" href="{{ route('admin.evaluation-transactions.index') }}">
                                    @lang('admin.Cancel')<i class="mdi mdi-arrow-left-bold"></i></a>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{ asset('/panel/js/upload.js') }}"></script>
<script src="{{ asset('/panel/js/validate.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $(".js-select2").select2({
            closeOnSelect: false
        });
        $(".js-select2-multi").select2({
            closeOnSelect: false
        });
    });

</script>
<script>
    $(document).ready(function() {
        $('#save').click(function(e) {
            $("#target").trigger("submit");

            // $('#save').prop('disabled', true);

        });


    });

</script>
<script type="text/javascript">
    $('#chick').click(function(e) {
        $('#invalid').text("");
        var value = $('#instrument_number-field').val();
        if (value.length > 0) {
            var url = "/admin/chick_instrument_number/" + value;
            $.ajax({
                type: 'get'
                , url: url
                , contentType: false
                , processData: false
                , success: (response) => {
                    $('#invalid').append(response);
                }

            });
        }



    });

    $('#check_new_region').click(function(e) {
        $('#new_region_check_result').text("");
        var url = "/admin/evaluation-transactions/check-new-region/?new_city_id=" +
            document.getElementById('new_city_id').value +
            '&plan_no=' + document.getElementById('plan_no').value +
            '&plot_no=' + document.getElementById('plot_no').value;
        $.ajax({
            type: 'get'
            , url: url
            , contentType: null
            , processData: null
            , success: (response) => {
                $('#new_region_check_result').append(response);
            }
        });
    });
    // $('#instrument_number-field').keydown(function(e) {
    //     $('#invalid').text("");
    //    var value= $('#instrument_number-field').val();
    //    if(value.length >0)
    //    {
    //    var url = "/admin/chick_instrument_number/"+value;      
    //     $.ajax({
    //             type:'get',
    //             url: url,
    //             contentType: false,
    //             processData: false,
    //             success: (response) => {
    //                 $('#invalid').text(response);
    //             }

    //        });
    //     }



    // });

</script>


<link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
@endsection
