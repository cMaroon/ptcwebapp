@if (Auth::guard('admin')->check())
    <p class="text-success">
        You are Logged In as a <strong>Admin</strong>
    </p>
@else
    <p class="text-danger">
        You are Logged Out as a <strong>Admin</strong>
    </p>
    
@endif

@if (Auth::guard('instructor')->check())
    <p class="text-success">
        You are Logged In as a <strong>Instructor</strong>
    </p>
@else
    <p class="text-danger">
        You are Logged Out as a <strong>Instructor</strong>
    </p>
    
@endif

@if (Auth::guard('student')->check())
    <p class="text-success">
        You are Logged In as a <strong>Student</strong>
    </p>
@else
    <p class="text-danger">
        You are Logged Out as a <strong>Student</strong>
    </p>
    
@endif