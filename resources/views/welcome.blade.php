<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Project Mangaement</title>

       
      
       <style>
       
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7f8;
            padding: 40px 20px;
            color: #333;
            max-width: 1000px;
            margin: 0 auto;
        }

        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 8px;
            margin-bottom: 25px;
        }

       
        form {
            background: #fff;
            padding: 20px 25px;
            border-radius: 8px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }

        form input[type="text"],
        form input[type="date"],
        form select,
        form input[type="file"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 18px;
            border: 1.5px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        form input[type="text"]:focus,
        form input[type="date"]:focus,
        form select:focus,
        form input[type="file"]:focus {
            border-color: #3498db;
            outline: none;
        }

        form button {
            background-color: #3498db;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #2980b9;
        }

        
        p[style*="color:green"] {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 10px 15px;
            border-radius: 6px;
            color: #155724;
            font-weight: 600;
            max-width: 500px;
        }

      
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 3px 12px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        table th,
        table td {
            text-align: left;
            padding: 14px 18px;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
            font-size: 0.95rem;
        }

        table th {
            background-color: #3498db;
            color: white;
            font-weight: 600;
            user-select: none;
        }

        table tr:hover {
            background-color: #f1f9ff;
        }

       
        td form {
            margin: 0;
        }

        td form input[type="text"],
        td form input[type="date"],
        td form select {
            width: auto;
            padding: 6px 8px;
            font-size: 0.85rem;
            margin-right: 8px;
            margin-bottom: 0;
        }

        td form input[type="file"] {
            padding: 4px 6px;
            font-size: 0.85rem;
            margin-right: 8px;
        }

        td form button {
            background-color: #27ae60;
            padding: 6px 14px;
            font-size: 0.85rem;
            margin-right: 8px;
            border-radius: 4px;
        }

        td form button:hover {
            background-color: #1e8449;
        }

        
        td form:last-child button {
            background-color: #e74c3c;
            padding: 6px 14px;
        }

        td form:last-child button:hover {
            background-color: #c0392b;
        }

        
        td a {
            color: #2980b9;
            text-decoration: none;
            font-weight: 600;
        }

        td a:hover {
            text-decoration: underline;
        }

       
        @media (max-width: 720px) {
            body {
                padding: 20px 10px;
            }
            table, thead, tbody, th, td, tr {
                display: block;
            }
            table tr {
                margin-bottom: 15px;
                border-bottom: 2px solid #ddd;
                padding-bottom: 15px;
            }
            table th {
                display: none;
            }
            table td {
                display: flex;
                justify-content: space-between;
                padding: 8px 12px;
                border: none;
                border-bottom: 1px solid #eee;
                font-size: 0.9rem;
            }
            table td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #555;
                flex-basis: 45%;
            }
            td form input[type="text"],
            td form input[type="date"],
            td form select,
            td form input[type="file"] {
                width: 100%;
                margin: 8px 0;
            }
            td form button {
                width: 48%;
                margin: 5px 1% 0 1%;
            }
            td form:last-child button {
                margin-top: 8px;
            }
        }
    </style>
    </head>
    <body>
        <h2>Create New Project </h2>
@if(session('success')) <p style="color:green">{{session('success')}}</p> @endif

<form method="POST"
action="{{route('projects.store')}}"
enctype="multipart/form-data">
@csrf
<input type="text" name="project_name" placeholder="Project Name" required><br><br>
<input type="date" name="project_date" required><br><br>
<select name="status"required>
  <option value=""> --select stustus--</option>
  <option value="Active">Active</option>
   <option value="Inactive">Inactive</option><br><br>
<input type="file" name="file"><br><br>
<button type="submit">Save Project</button>
</form>


<h2> ALL Projects</h2>
<table>
    <tr>
        <th>ID</th>
          <th>Project Name</th>
            <th>Date</th>
              <th>Status</th>
                <th>File</th>
                  <th>Actions</th>
</tr>
@foreach($projects as $project)
<tr>
<td>{{$project->id}}</td>
<td>{{$project->project_name}}</td>
<td>{{$project->project_date}}</td>
<td>{{$project->status}}</td>
<td>
@if($project->file)
<a href="{{ asset('storage/'.
$project->file)}}" target="_blank">View</a>
@else NO file @endif
</td>
<td>
<form method="POST"
action="{{ route('projects.update', $project->id) }}"enctype="multipart/form-data"
style="display:inline-block;">
@csrf 
<input type="text" name="project_name" value="{{$project->project_name}}" required>
<input type="date" name="project_date" value="{{$project->project_date}}" required>
<select name="status" required>
    <option value="Active" {{ $project->status == 'Active' ? 'selected' : '' }}>Active</option>
    <option value="Inactive" {{ $project->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
</select>

<input type="file" name="file">

<button type="submit">Update</button>
</form>
 <form action="{{ route('project.delete', $project->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this project?')">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form></td>



</tr>
@endforeach
</table>
    </body>
</html>
