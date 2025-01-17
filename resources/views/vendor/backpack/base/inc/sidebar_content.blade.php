<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
@if(backpack_user()->id == 1)
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon la la-question'></i> Users</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('course') }}'><i class='nav-icon la la-question'></i> Courses</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('student') }}'><i class='nav-icon la la-question'></i> Students</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('classe') }}'><i class='nav-icon la la-question'></i> Classes</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('attendance') }}'><i class='nav-icon la la-question'></i> Attendances</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('exam') }}'><i class='nav-icon la la-question'></i> Exams</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('question') }}'><i class='nav-icon la la-question'></i> Questions</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('answer') }}'><i class='nav-icon la la-question'></i> Answers</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('test') }}'><i class='nav-icon la la-question'></i> Tests</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('students-answer') }}'><i class='nav-icon la la-question'></i> Students answers</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('dailypoint') }}'><i class='nav-icon la la-question'></i> Dailypoints</a></li>
@endif