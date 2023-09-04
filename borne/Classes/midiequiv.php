<?php

// MIDI Equivalence from MIDI Specification 1.1
// Note 0 is equivalent to C Octave -1
// Middle C Octave 0 is equivalent to Note 12

// In Ableton and MidiViewer Note 12 is equivalent to C Octave -1
// So for proper conversion TO Ableton, please ADD ONE octave

define("MIDIEQUIV", array(
    "A-22" => -255,
    "Bb-22" => -254,
    "B-22" => -253,
    "C-22" => -252,
    "C#-21" => -251,
    "D-21" => -250,
    "D#-21" => -249,
    "E-21" => -248,
    "F-21" => -247,
    "F#-21" => -246,
    "G-21" => -245,
    "G#-21" => -244,
    "A-21" => -243,
    "Bb-21" => -242,
    "B-21" => -241,
    "C-21" => -240,
    "C#-20" => -239,
    "D-20" => -238,
    "D#-20" => -237,
    "E-20" => -236,
    "F-20" => -235,
    "F#-20" => -234,
    "G-20" => -233,
    "G#-20" => -232,
    "A-20" => -231,
    "Bb-20" => -230,
    "B-20" => -229,
    "C-20" => -228,
    "C#-19" => -227,
    "D-19" => -226,
    "D#-19" => -225,
    "E-19" => -224,
    "F-19" => -223,
    "F#-19" => -222,
    "G-19" => -221,
    "G#-19" => -220,
    "A-19" => -219,
    "Bb-19" => -218,
    "B-19" => -217,
    "C-19" => -216,
    "C#-18" => -215,
    "D-18" => -214,
    "D#-18" => -213,
    "E-18" => -212,
    "F-18" => -211,
    "F#-18" => -210,
    "G-18" => -209,
    "G#-18" => -208,
    "A-18" => -207,
    "Bb-18" => -206,
    "B-18" => -205,
    "C-18" => -204,
    "C#-17" => -203,
    "D-17" => -202,
    "D#-17" => -201,
    "E-17" => -200,
    "F-17" => -199,
    "F#-17" => -198,
    "G-17" => -197,
    "G#-17" => -196,
    "A-17" => -195,
    "Bb-17" => -194,
    "B-17" => -193,
    "C-17" => -192,
    "C#-16" => -191,
    "D-16" => -190,
    "D#-16" => -189,
    "E-16" => -188,
    "F-16" => -187,
    "F#-16" => -186,
    "G-16" => -185,
    "G#-16" => -184,
    "A-16" => -183,
    "Bb-16" => -182,
    "B-16" => -181,
    "C-16" => -180,
    "C#-15" => -179,
    "D-15" => -178,
    "D#-15" => -177,
    "E-15" => -176,
    "F-15" => -175,
    "F#-15" => -174,
    "G-15" => -173,
    "G#-15" => -172,
    "A-15" => -171,
    "Bb-15" => -170,
    "B-15" => -169,
    "C-15" => -168,
    "C#-14" => -167,
    "D-14" => -166,
    "D#-14" => -165,
    "E-14" => -164,
    "F-14" => -163,
    "F#-14" => -162,
    "G-14" => -161,
    "G#-14" => -160,
    "A-14" => -159,
    "Bb-14" => -158,
    "B-14" => -157,
    "C-14" => -156,
    "C#-13" => -155,
    "D-13" => -154,
    "D#-13" => -153,
    "E-13" => -152,
    "F-13" => -151,
    "F#-13" => -150,
    "G-13" => -149,
    "G#-13" => -148,
    "A-13" => -147,
    "Bb-13" => -146,
    "B-13" => -145,
    "C-13" => -144,
    "C#-12" => -143,
    "D-12" => -142,
    "D#-12" => -141,
    "E-12" => -140,
    "F-12" => -139,
    "F#-12" => -138,
    "G-12" => -137,
    "G#-12" => -136,
    "A-12" => -135,
    "Bb-12" => -134,
    "B-12" => -133,
    "C-12" => -132,
    "C#-11" => -131,
    "D-11" => -130,
    "D#-11" => -129,
    "E-11" => -128,
    "F-11" => -127,
    "F#-11" => -126,
    "G-11" => -125,
    "G#-11" => -124,
    "A-11" => -123,
    "Bb-11" => -122,
    "B-11" => -121,
    "C-11" => -120,
    "C#-10" => -119,
    "D-10" => -118,
    "D#-10" => -117,
    "E-10" => -116,
    "F-10" => -115,
    "F#-10" => -114,
    "G-10" => -113,
    "G#-10" => -112,
    "A-10" => -111,
    "Bb-10" => -110,
    "B-10" => -109,
    "C-10" => -108,
    "C#-9" => -107,
    "D-9" => -106,
    "D#-9" => -105,
    "E-9" => -104,
    "F-9" => -103,
    "F#-9" => -102,
    "G-9" => -101,
    "G#-9" => -100,
    "A-9" => -99,
    "Bb-9" => -98,
    "B-9" => -97,
    "C-9" => -96,
    "C#-8" => -95,
    "D-8" => -94,
    "D#-8" => -93,
    "E-8" => -92,
    "F-8" => -91,
    "F#-8" => -90,
    "G-8" => -89,
    "G#-8" => -88,
    "A-8" => -87,
    "Bb-8" => -86,
    "B-8" => -85,
    "C-8" => -84,
    "C#-7" => -83,
    "D-7" => -82,
    "D#-7" => -81,
    "E-7" => -80,
    "F-7" => -79,
    "F#-7" => -78,
    "G-7" => -77,
    "G#-7" => -76,
    "A-7" => -75,
    "Bb-7" => -74,
    "B-7" => -73,
    "C-7" => -72,
    "C#-6" => -71,
    "D-6" => -70,
    "D#-6" => -69,
    "E-6" => -68,
    "F-6" => -67,
    "F#-6" => -66,
    "G-6" => -65,
    "G#-6" => -64,
    "A-6" => -63,
    "Bb-6" => -62,
    "B-6" => -61,
    "C-6" => -60,
    "C#-5" => -59,
    "D-5" => -58,
    "D#-5" => -57,
    "E-5" => -56,
    "F-5" => -55,
    "F#-5" => -54,
    "G-5" => -53,
    "G#-5" => -52,
    "A-5" => -51,
    "Bb-5" => -50,
    "B-5" => -49,
    "C-5" => -48,
    "C#-4" => -47,
    "D-4" => -46,
    "D#-4" => -45,
    "E-4" => -44,
    "F-4" => -43,
    "F#-4" => -42,
    "G-4" => -41,
    "G#-4" => -40,
    "A-4" => -39,
    "Bb-4" => -38,
    "B-4" => -37,
    "C-4" => -36,
    "C#-3" => -35,
    "D-3" => -34,
    "D#-3" => -33,
    "E-3" => -32,
    "F-3" => -31,
    "F#-3" => -30,
    "G-3" => -29,
    "G#-3" => -28,
    "A-3" => -27,
    "Bb-3" => -26,
    "B-3" => -25,
    "C-3" => -24,
    "C#-2" => -23,
    "D-2" => -22,
    "D#-2" => -21,
    "E-2" => -20,
    "F-2" => -19,
    "F#-2" => -18,
    "G-2" => -17,
    "G#-2" => -16,
    "A-2" => -15,
    "Bb-2" => -14,
    "B-2" => -13,
    "C-2" => -12,
    "C#-1" => 1,
    "D-1" => 2,
    "D#-1" => 3,
    "E-1" => 4,
    "F-1" => 5,
    "F#-1" => 6,
    "G-1" => 7,
    "G#-1" => 8,
    "A-1" => 9,
    "Bb-1" => 10,
    "B-1" => 11,
    "C-1" => 0,
    "C0" => 12,
    "C#0" => 13,
    "D0" => 14,
    "D#0" => 15,
    "E0" => 16,
    "F0" => 17,
    "F#0" => 18,
    "G0" => 19,
    "G#0" => 20,
    "A0" => 21,
    "Bb0" => 22,
    "B0" => 23,
    "C1" => 24,
    "C#1" => 25,
    "D1" => 26,
    "D#1" => 27,
    "E1" => 28,
    "F1" => 29,
    "F#1" => 30,
    "G1" => 31,
    "G#1" => 32,
    "A1" => 33,
    "Bb1" => 34,
    "B1" => 35,
    "C2" => 36,
    "C#2" => 37,
    "D2" => 38,
    "D#2" => 39,
    "E2" => 40,
    "F2" => 41,
    "F#2" => 42,
    "G2" => 43,
    "G#2" => 44,
    "A2" => 45,
    "Bb2" => 46,
    "B2" => 47,
    "C3" => 48,
    "C#3" => 49,
    "D3" => 50,
    "D#3" => 51,
    "E3" => 52,
    "F3" => 53,
    "F#3" => 54,
    "G3" => 55,
    "G#3" => 56,
    "A3" => 57,
    "Bb3" => 58,
    "B3" => 59,
    "C4" => 60,
    "C#4" => 61,
    "D4" => 62,
    "D#4" => 63,
    "E4" => 64,
    "F4" => 65,
    "F#4" => 66,
    "G4" => 67,
    "G#4" => 68,
    "A4" => 69,
    "Bb4" => 70,
    "B4" => 71,
    "C5" => 72,
    "C#5" => 73,
    "D5" => 74,
    "D#5" => 75,
    "E5" => 76,
    "F5" => 77,
    "F#5" => 78,
    "G5" => 79,
    "G#5" => 80,
    "A5" => 81,
    "Bb5" => 82,
    "B5" => 83,
    "C6" => 84,
    "C#6" => 85,
    "D6" => 86,
    "D#6" => 87,
    "E6" => 88,
    "F6" => 89,
    "F#6" => 90,
    "G6" => 91,
    "G#6" => 92,
    "A6" => 93,
    "Bb6" => 94,
    "B6" => 95,
    "C7" => 96,
    "C#7" => 97,
    "D7" => 98,
    "D#7" => 99,
    "E7" => 100,
    "F7" => 101,
    "F#7" => 102,
    "G7" => 103,
    "G#7" => 104,
    "A7" => 105,
    "Bb7" => 106,
    "B7" => 107,
    "C8" => 108,
    "C#8" => 109,
    "D8" => 110,
    "D#8" => 111,
    "E8" => 112,
    "F8" => 113,
    "F#8" => 114,
    "G8" => 115,
    "G#8" => 116,
    "A8" => 117,
    "Bb8" => 118,
    "B8" => 119,
    "C9" => 120,
    "C#9" => 121,
    "D9" => 122,
    "D#9" => 123,
    "E9" => 124,
    "F9" => 125,
    "F#9" => 126,
    "G9" => 127,
    "G#9" => 128,
    "A9" => 129,
    "Bb9" => 130,
    "B9" => 131,
    "C10" => 132,
    "C#10" => 133,
    "D10" => 134,
    "D#10" => 135,
    "E10" => 136,
    "F10" => 137,
    "F#10" => 138,
    "G10" => 139,
    "G#10" => 140,
    "A10" => 141,
    "Bb10" => 142,
    "B10" => 143,
    "C11" => 144,
    "C#11" => 145,
    "D11" => 146,
    "D#11" => 147,
    "E11" => 148,
    "F11" => 149,
    "F#11" => 150,
    "G11" => 151,
    "G#11" => 152,
    "A11" => 153,
    "Bb11" => 154,
    "B11" => 155,
    "C12" => 156,
    "C#12" => 157,
    "D12" => 158,
    "D#12" => 159,
    "E12" => 160,
    "F12" => 161,
    "F#12" => 162,
    "G12" => 163,
    "G#12" => 164,
    "A12" => 165,
    "Bb12" => 166,
    "B12" => 167,
    "C13" => 168,
    "C#13" => 169,
    "D13" => 170,
    "D#13" => 171,
    "E13" => 172,
    "F13" => 173,
    "F#13" => 174,
    "G13" => 175,
    "G#13" => 176,
    "A13" => 177,
    "Bb13" => 178,
    "B13" => 179,
    "C14" => 180,
    "C#14" => 181,
    "D14" => 182,
    "D#14" => 183,
    "E14" => 184,
    "F14" => 185,
    "F#14" => 186,
    "G14" => 187,
    "G#14" => 188,
    "A14" => 189,
    "Bb14" => 190,
    "B14" => 191,
    "C15" => 192,
    "C#15" => 193,
    "D15" => 194,
    "D#15" => 195,
    "E15" => 196,
    "F15" => 197,
    "F#15" => 198,
    "G15" => 199,
    "G#15" => 200,
    "A15" => 201,
    "Bb15" => 202,
    "B15" => 203,
    "C16" => 204,
    "C#16" => 205,
    "D16" => 206,
    "D#16" => 207,
    "E16" => 208,
    "F16" => 209,
    "F#16" => 210,
    "G16" => 211,
    "G#16" => 212,
    "A16" => 213,
    "Bb16" => 214,
    "B16" => 215,
    "C17" => 216,
    "C#17" => 217,
    "D17" => 218,
    "D#17" => 219,
    "E17" => 220,
    "F17" => 221,
    "F#17" => 222,
    "G17" => 223,
    "G#17" => 224,
    "A17" => 225,
    "Bb17" => 226,
    "B17" => 227,
    "C18" => 228,
    "C#18" => 229,
    "D18" => 230,
    "D#18" => 231,
    "E18" => 232,
    "F18" => 233,
    "F#18" => 234,
    "G18" => 235,
    "G#18" => 236,
    "A18" => 237,
    "Bb18" => 238,
    "B18" => 239,
    "C19" => 240,
    "C#19" => 241,
    "D19" => 242,
    "D#19" => 243,
    "E19" => 244,
    "F19" => 245,
    "F#19" => 246,
    "G19" => 247,
    "G#19" => 248,
    "A19" => 249,
    "Bb19" => 250,
    "B19" => 251,
    "C20" => 252,
    "C#20" => 253,
    "D20" => 254,
));