@extends('layouts.app')

@section('content')
<style>
       .avatar-wrapper {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 20px auto;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: all .3s ease;
            &:hover{
                transform: scale(1.05);
                cursor: pointer;
            }
            &:hover .profile-pic{
                opacity: .5;
            }
        .profile-pic {
            height: 100%;
            width: 100%;
            transition: all .3s ease;
            &:after{
                font-family: FontAwesome;
                content: "\f007";
                top: 0; left: 0;
                width: 100%;
                height: 100%;
                position: absolute;
                font-size: 190px;
                background: #ecf0f1;
                color: #34495e;
                text-align: center;
            }
        }
        .upload-button {
            position: absolute;
            top: 0; left: 0;
            height: 100%;
            width: 100%;
            .fa-arrow-circle-up{
                position: absolute;
                font-size: 234px;
                top: -17px;
                left: 0;
                text-align: center;
                opacity: 0;
                transition: all .3s ease;
                color: #34495e;
            }
            &:hover .fa-arrow-circle-up{
                opacity: .9;
            }
        }
    }

    .btn-success, .btn-danger {
        border-radius: 20px; /* ทำให้ปุ่มมีรูปทรงมน */
        padding: 10px 20px; /* เพิ่มระยะห่างระหว่างข้อความและขอบปุ่ม */
        font-weight: bold; /* ทำให้ข้อความในปุ่มหนาขึ้น */
        transition: all 0.3s ease; /* เพิ่มการเปลี่ยนแปลงอย่างราบรื่นเมื่อเคลื่อนเมาส์ผ่าน */
        }

        .btn-success:hover, .btn-danger:hover {
        transform: translateY(-2px); /* เพิ่มเอฟเฟกต์ยกปุ่มขึ้นเล็กน้อยเมื่อเคลื่อนเมาส์ผ่าน */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* เพิ่มเงาให้ปุ่ม */
        }

        .form-control {
  border-radius: 10px; /* ทำให้ช่องกรอกข้อมูลมีรูปทรงมน */
  padding: 10px; /* เพิ่มระยะห่างระหว่างข้อความและขอบช่องกรอกข้อมูล */
  font-family: 'Montserrat', sans-serif; /* เปลี่ยนฟอนต์ตัวอักษร */
  color: #333; /* เปลี่ยนสีตัวอักษร */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* เพิ่มเงาให้ช่องกรอกข้อมูล */
}

.card {
  background-color: rgba(255, 255, 255, 0.8); /* พื้นหลังของกล่องข้อมูลมีความโปร่งใส */
  border-radius: 20px; /* ทำให้กล่องข้อมูลมีรูปทรงมน */
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* เพิ่มเงาให้กล่องข้อมูล */
}

.upload-button .fa-arrow-circle-up:after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('https://source.unsplash.com/random/500x500');
  background-size: cover;
  opacity: 0.5;
  z-index: -1;
  border-radius: 50%;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('updateprofile', Auth::user()->id ) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="avatar-wrapper">
                            <img class="profile-pic" src="{{ Auth::user()->avatar ? Auth::user()->avatar : "https://www.w3schools.com/howto/img_avatar.png" }}" />
                            <div class="upload-button">
                                <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                            </div>
                            <input class="file-upload" type="file" accept="image/*" name="avatar" id="avatar"/>
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">ชื่อ</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ Auth::user()->name }}">
                          </div>
                          <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">อีเมล</label>
                            <input type="text" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}">
                        </div>
                        <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}">
                        <div class="col-12 d-flex justify-content-center">
                            <div class="m-2">
                            <button type="submit" class="btn btn-success">บันทึก</button>
                            </div>
                            <div class="m-2">
                            <a href="{{ route('profile') }}" class="btn btn-danger">ยกเลิก</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
	
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
   
    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});
</script>
@endsection
