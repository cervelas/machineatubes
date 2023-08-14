# Machine A Tubes

Software for the Machine A Tubes project


## Requirements

- Python version 3.10 with pip
- Something to play Midi (Windows: Wavetable Synth is integrated, Mac: https://github.com/notahat/simplesynth ??)

## Installation

Install Python.

Move to the downloaded folder.

Install it in development mode:

```bash
pip install -e .
```

The media used by a song shall be present in the `example` folder.

This is temporary, as this need to be more flexible.

## Usage

Once installed, you should have the `mat` command available system-wide.

Executing it alone give you a standard window with some options :

- press `L` for loading a json or xml file.
- press `d` to show or hide the debug bar.
- press `f` to toggle fullscreen.

Call for help:

```bash
> mat -h
usage: MachineaTubes [-h] [--file FILE] [--out OUT] [--bpm BPM] [-v] [-np] [--no-ui] [--midiout {0}]

La Machine a Tube

options:
  -h, --help     show this help message and exit
  --file FILE    File to play (json or xml)
  --out OUT      Export to json
  --bpm BPM      BPM
  -v, --verbose  Verbose Mode
  -np, --noplay  Wait enter for play
  --no-ui        do not start UI
  --midiout {0}  Output Midi Device Number, Default is 0 (Microsoft GS Wavetable Synth 0)

                 0: Microsoft GS Wavetable Synth 0

Clément Borel
```

## API Usage

The http server expose `http://localhost:23456/play` endpoint.

it accept ONLY a json file by POST method :

`> curl -i -H "Content-Type: application/json" -X POST -d '{"some":"json", "random": "file"}' http://localhost:23456/play`

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

Private