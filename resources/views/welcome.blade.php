@extends('layouts.app')

@section('title', 'Task Management System')

@section('content')
    {{-- Hero Section --}}

    <div class="hero">

            <div style="text-align: center;" class="hero-content">
                <div
                    style="text-align: center; font-size:40px; font-family:  'Montserrat', 'Poppins', 'Segoe UI', sans-serif;">
                    Productivity through <span style="font-weight: bold;">Planning.</span>
                </div>
                <p
                    style="letter-spacing: 4px; text-align: center; font-size: 15px; margin-top: 10px; font-family:  'Montserrat', 'Poppins', 'Segoe UI', sans-serif;">
                    Assign. Track. Complete.
            </p>
            <button type="button" class="read-more-btn">Read More >>
            </button>
            </div>



    </div>




    {{-- Call to Action --}}
    {{-- <section class="cta">
        <h3>Start building something great today!</h3>
        <a href="{{ url('/contact') }}" class="cta-btn">Contact Us</a>
    </section> --}}
@endsection
