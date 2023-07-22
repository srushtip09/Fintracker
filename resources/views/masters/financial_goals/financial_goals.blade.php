@extends('layouts.app')

@section('page-title', 'Financial Goals')

@section('page-styles')

@endsection

@section('page-content')
    <div class="d-flex justify-content-end w-100">
        <div class="">
            <a href="{{ route('financial_goals.create') }}" class="btn btn-outline-white btn-icon text-white" type="button">
                <span class=""><i class="fa fa-bullseye"></i></span>
                <span class="btn-inner--text">Add Financial Goal</span>
            </a>
        </div>
    </div>
    <div class="row justify-content-sm-around">
        @if($financialGoals->isEmpty())
            <div class="card mb-3 p-3 d-flex justify-content-center col-md-5">
                <div class="card-title p-3 fw-bolder fs-2">No financial goals</div>
                <div class="card-body p-3">
                    Currently you have not set any financial goals
                </div>
            </div>
        @else
            @foreach ($financialGoals as $financialGoal)
                <div class="card mb-3 p-3 d-flex justify-content-center col-md-5">
                    <div class="card-title p-3 fw-bolder fs-2 w-100 d-flex justify-content-between">
                        <div>
                            {{$financialGoal->name}}
                        </div>
                        <div>
                            {{-- <span class="badge bg-gradient-info">{{$financialGoal->priority}}</span> --}}
                            <button type="button"
                                    class="btn btn-primary mb-0"
                                    onclick="removeGoalHelper(event, {{$financialGoal->id}})" data-bs-toggle="modal" data-bs-target="#removeGoalModal">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        @if($financialGoal->percentage >= 80 && $financialGoal->percentage <= 100)
                            <p class="mb-0"><strong>At the same pace you can achieve the goal easily</strong></p>
                        @elseif($financialGoal->percentage >= 60 && $financialGoal->percentage < 80)
                            <p class="mb-0"><strong>You will have to save little more to achieve the goal</strong></p>
                        @elseif($financialGoal->percentage >= 40 && $financialGoal->percentage < 60)
                            <p class="mb-0"><strong>You will have to save more money to achieve the goal</strong></p>
                        @elseif($financialGoal->percentage >= 20 && $financialGoal->percentage < 40)
                            <p class="mb-0"><strong>To achieve this goal more time will be needed</strong></p>
                        @elseif($financialGoal->percentage >=0 && $financialGoal->percentage < 20)
                            <p class="mb-0"><strong>You cannot achieve this goal this year</strong></p>
                        @endif
                        <div class="progress-bar-container">
                            <p class="mb-0 d-flex justify-content-end">Goal Amount:  <strong>{{$financialGoal->amount}}</strong></p>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{$financialGoal->percentage}}%">{{$financialGoal->percentage}}%</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        @include('masters.financial_goals.partials._modals')
    </div>

@endsection
@section('page-scripts')
    <script>
        function removeGoalHelper(e, $goalId) {
            var url = '/admin/financial_goals/' + $goalId;
            $('#removeGoalForm').attr('action', url);
        }
    </script>
@endsection
