<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesson Table</title>
    <!-- You can include additional styling or use an external CSS file here -->
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .comment-input {
            width: 100%;
        }
    </style>
</head>
<body>

<h2>Lesson Table</h2>

<table>
    <thead>
        <tr>
            <th>S.No</th>
            <th>Lesson Name</th>
            <th>Comment</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lessons as $lesson)
        <tr>
       
            <td>1</td>
            <td>{{$lesson->title}}</td>
            <td>
                <input type="text" class="comment-input" placeholder="Add Comment">
                <button >Submit</button>
            </td>
            <td>
               <a href="{{ route('watched.lesson', ['user' => 1,'lesson'=>$lesson->id,]) }}"> <button >Action</button></a>
            </td>            
           
        </tr>
        @endforeach
    </tbody>
</table>



</body>
</html>
