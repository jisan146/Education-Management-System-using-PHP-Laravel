<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <style>
        table {
        border-collapse: collapse;
        }
        table, td, th {
        border: 1px solid black;
        }
        @font-face {
        font-family: myFirstFont;
        @if (session('client_id')=='14')
        
        src: url({{url('/')}}/assets/kalpurush.ttf);
        
        
        @endif
        }
        
        th {
        font-family:myFirstFont;
        font-size:20px;
        }
        td {
        font-family:myFirstFont;
        font-size:20px;
        }
        h1 {
        font-family:myFirstFont;
        
        }
        h3 {
        font-family:myFirstFont;
        
        }
        h2 {
        font-family:myFirstFont;
        
        }
        input {
        font-family:myFirstFont;
        font-size:20px;
        }
        </style>
    </head>
    <body>
        <h1 align="center" style="margin-bottom: -20px;">{{session('iname')}}</h1>
        <h3 align="center" style="margin-bottom: -20px;">{{session('iadd')}}</h3>
        <h2 align="center" style="margin-bottom: -20px;">{{session('iclass')}}</h3>
        <h2 align="center" style="margin-bottom: -10px;"><b>{{session('iex')}} - {{test(date("Y"))}}</b></h3>
        <hr>
        <br>
        <table align="center" border="1">
            <thead>
                <tr>
                </tr>
                <tr>
                    <!--  @if (session('client_id')=='14')
                    
                    @else
                    
                    @endif
                    -->
                    
                    @if (session('client_id')=='14')
                    <th>শিক্ষার্থীর আইডি</th>
                    @else
                    <th>Student ID</th>
                    @endif
                    @if (session('client_id')=='14')
                    <th>নাম</th>
                    @else
                    <th>Name</th>
                    @endif
                    
                    @php
                    {{
                    $roll=0;
                    function test($a)
                    {
                    $n=$a;
                    $n= str_replace('0','০',$n);
                    $n= str_replace('1','১',$n);
                    $n= str_replace('2','২',$n);
                    $n= str_replace('3','৩',$n);
                    $n= str_replace('4','৪',$n);
                    $n= str_replace('5','৫',$n);
                    $n= str_replace('6','৬',$n);
                    $n= str_replace('7','৭',$n);
                    $n= str_replace('8','৮',$n);
                    $n= str_replace('9','৯',$n);
                    if (session('client_id')=='14')
                    {return $n;}else{return $a;}
                    
                    }
                    function grade($a,$em)
                    {
                    
                         if (session('client_id')=='14')
                    {
                   

                    if ($a>=80)
                    {
                    return 'মুমতাষ';
                    }
                    else if ($a>=65)
                    {
                    return 'জাঃ জিদ্দান';
                    }
                    else if ($a>=50)
                    {
                    return 'জায়্যিদ';
                    }
                    else if ($a>=35)
                    {
                    return 'মাকবুল';
                    }
                    else
                    {
                    return 'ফেল';
                    }

                }
                else
                    {
                       if ($a>=($em/100)*80 && $a<=($em/100)*100)
                    {
                    return 'A+';
                    }
                    else if ($a>=($em/100)*70)
                    {
                    return 'A';
                    }
                    else if ($a>=($em/100)*60)
                    {
                    return 'A-';
                    }
                    else if ($a>=($em/100)*50)
                    {
                    return 'B';
                    }
                    else if ($a>=($em/100)*40)
                    {
                    return 'C';
                    }
                    else if ($a>=($em/100)*33)
                    {
                    return 'D';
                    }
                    else if ($a<($em/100)*32)
                    {
                    return 'F';
                    }
                    }
                    
                    
                    }

                    function grade_point($a,$em)
                    {
                    
                         if (session('client_id')=='14')
                    {
                   

                    if ($a>=80)
                    {
                    return 'মুমতাষ';
                    }
                    else if ($a>=65)
                    {
                    return 'জাঃ জিদ্দান';
                    }
                    else if ($a>=50)
                    {
                    return 'জায়্যিদ';
                    }
                    else if ($a>=35)
                    {
                    return 'মাকবুল';
                    }
                    else
                    {
                    return 'ফেল';
                    }

                }
                else
                    {

                       if ($a==5)
                    {
                    return 'A+';
                    }
                    else if ($a>=4)
                    {
                    return 'A';
                    }
                    else if ($a>=3.75)
                    {
                    return 'A-';
                    }
                    else if ($a>=3)
                    {
                    return 'B';
                    }
                    else if ($a>=2)
                    {
                    return 'C';
                    }
                    else if ($a>=1)
                    {
                    return 'D';
                    }
                    else
                    {
                    return 'F';
                    }
                    }
                    
                    
                    }
                    function roll($id)
                    {
                        $roll=DB::select('select roll from gpa where user_id=?',[$id]);
                        foreach ($roll as $key ) {
                            $roll=$key->roll;
                            return $roll;
                        }
                    }


                    $head_tn=0;
                    }}
                    @endphp
                    @foreach ($data as $data)
                    @php
                        {{$en='EM'.session('p3');$head_tn=$head_tn+$data->$en;}}
                    @endphp
                    <th style="width: 60px;">{{$data->SUBJECT}} ({{test($data->$en)}})</th>
                    
                    @endforeach
                    @if (session('client_id')=='14')
                    <th style="width: 60px;">মোট ({{test($head_tn)}})</th>
                    @else
                    <th style="width: 60px;">Total ({{test($head_tn)}})</th>
                    @endif
                    
                    @if (session('client_id')=='14')
                    <th style="width: 60px;">গড়</th>
                    @else
                    <th style="width: 60px;">Average</th>
                    @endif
                    
                    @if (session('client_id')=='14')
                    <th style="width: 80px;">বিভাগ</th>
                    @else
                    <th style="width: 80px;">Letter Grade</th>
                    @endif

                    @if (session('client_id')=='14')
                    <th style="width: 80px;">পয়েন্ট</th>
                    @else
                    <th style="width: 80px;">Grade Point</th>
                    @endif
                    
                    @if (session('client_id')=='14')
                    <th style="width: 60px;">রোল</th>
                    @else
                    <th style="width: 60px;">Roll</th>
                    @endif
                    
                    
                </tr>
            </thead>
            <tbody>
                
                @foreach ($row1 as $row2)
                @php
                {{$roll=$roll+1;}}
                @endphp
                <tr>
                    <td>{{test($row2->sl)}}</td>
                    <td>{{$row2->name}}</td>
                    
                    @foreach ($data2 as $data6)
                    @php
                    {{$Field='a'.$data6->SL;}} 
                    {{$Field1='e'.$data6->SL;}}
                    
                    @endphp 
                    <td style="text-align: center;">
                        {{test($row2->$Field)}} 
                        <!-- <br>{{$row2->$Field1}} total_em-->
                        
                    </td>
                    
                    
                    @endforeach
                    <td style="text-align: center;">
                        {{test($row2->Total)}}
                        
                    </td>
                    <td style="text-align: center;">
                        {{test($row2->avg)}}
                        
                    </td>
                    <td  style="text-align: center; @if (grade($row2->avg,$row2->total_em)=='ফেল'||grade($row2->avg,$row2->total_em)=='F')
                        color:red;
                        @endif">
                        @if (session('client_id')==14)
                           {{grade_point($row2->avg,$row2->total_em)}}  
                            @else
                          {{grade_point($row2->gpavg,$row2->total_em)}}  
                        @endif
                        
                    </td>

                    <td  style="text-align: center; @if (grade($row2->avg,$row2->total_em)=='ফেল'||grade($row2->avg,$row2->total_em)=='F')
                        color:red;
                        @endif">
                        {{test($row2->gpavg)}}
                    </td>


                    <td style="text-align: center;">
                        {{test(roll($row2->sl))}}

                        
                        
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td style="border-bottom: hidden; border-left: hidden;border-right: hidden" colspan="100%"><p style="margin-top: 50px;" align="right"><input style="text-align: center ;margin-bottom: -8px;border-style: ridge hidden hidden hidden;" 
                        @if (session('client_id')=='14')
                    value="শিক্ষা সচিব"
                    @else
                     value="Principal"
                    @endif
                       
                        ></input></p></td>
                </tr>
                
            </tbody>
            <!--<tfoot>
            <tr>
                <th>শিক্ষার্থীর আইডি</th>
                <th>নাম</th>
                
                @foreach ($data1 as $data1)
                <th style="transform: rotate(-90deg);" >{{$data1->SUBJECT}}</th>
                
                @endforeach
            </tr>
            </tfoot>-->
            
        </table>
        
    </body>
</html>